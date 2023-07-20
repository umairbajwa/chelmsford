<?php

namespace App\Mail;

use App\Account;
use App\Products;
use App\Questions;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookAppointment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $quote, $finalDetails;
    public $view;

    public function __construct($quote, $view)
    {
        $this->view = $view;
        $this->quote = $quote;
        $this->finalDetails = unserialize($quote->final_details);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->finalDetails['addons']);
        $questionsData = $this->getQuestionsData();
        $product = $this->getProduct($this->finalDetails['product_id']);
        $water = $this->finalDetails['water'] ? $this->getProduct($this->finalDetails['water']) : NULL;
        $addons = $this->finalDetails['addons'] ? $this->getAddons($this->finalDetails['addons']) : [];
        $totalvalue = $this->finalDetails['totalvalue'];
        $subTotalRows = $this->finalDetails['subTotalRows'];
        $subtotal = $this->finalDetails['subtotal'];
        $totalForBoiler = $this->finalDetails['totalForBoiler'];
        $quote = $this->quote;
        $globalPdf = NULL;
        $productPdf = NULL;
        $toReturn =  $this->view('mail.' . $this->view, compact('questionsData', 'product', 'water', 'addons', 'totalvalue', 'subTotalRows', 'subtotal', 'quote', 'totalForBoiler'))->subject("Your New Boiler Estimate")->with('quote', $this->quote);
        if ($this->view == 'mail.newBookAppoitment') {
            if ($product->global_pdf) {
                $globalPdf = $product->global_pdf;
                $toReturn->attach(public_path() . '/storage/products/' . $globalPdf, ['as' => 'Generic.pdf', 'mime' => 'application/pdf']);
            }
            if ($product->pdf) {
                $productPdf = $product->pdf;
                $toReturn->attach(public_path() . '/storage/products/' .  $productPdf, ['as' => 'Products.pdf', 'mime' => 'application/pdf']);
            }
        }
        return $toReturn;
    }

    private function getProduct($id)
    {
        return Products::find($id);
    }

    public function getAddons($ids)
    {
        $addons = [];
        foreach ($ids as $key => $id) {
            $addons[] = Products::find($id);
        }
        return $addons;
    }


    private function getQuestionsData()
    {
        $questionIds = unserialize($this->quote->quote_data);
        $questionData = unserialize($this->quote->quote_option_data);
        $questionsArray = [];
        foreach ($questionIds as $id => $value) {
            $question = Questions::where('id', $id)->orderBy('order', 'ASC')->orderBy('id', 'ASC')->first();
            $options = unserialize($question->options);
            $answer = null;
            if (isset($questionData[$id])) {
                if (is_array($questionData[$id])) {
                    $answer = [];
                    foreach ($questionData[$id] as $dataId => $dataValue) {
                        if ($dataValue != 0) {
                            $answer[] = [
                                'question' => $options[$dataId]['text'],
                                'qty' => $dataValue
                            ];
                        }
                    }
                } else {
                    $answer = $questionData[$id];
                }
            } else {
                $answer = $options[$value]['text'];
            }
            $questionsArray[] = [
                'question' => $question->question,
                'answer' => $answer,
            ];
        }
        // dd($questionsArray);
        return $questionsArray;
    }
}

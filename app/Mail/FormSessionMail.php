<?php

namespace App\Mail;

use App\Account;
use App\Questions;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormSessionMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $formData, $partial, $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($formData, $partial = false, $url = null)
    {
        $this->formData = $formData;
        $this->partial = $partial;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $questionsData = $this->getQuestionsData();
        return $this->view('mail.FormSessionMail')->subject("Continue from where you left quote")->with('questionsData', $questionsData)->with('formData', $this->formData)->with('partial', $this->partial)->with('url' , $this->url);
    }

    private function getQuestionsData()
    {
        $account = Account::where('url', request()->root())->first();
        $questionIds = $this->formData['option'];
        $questionData = $this->formData['optiondata'];
        $questionsArray = [];
        foreach ($questionIds as $id => $value) {
            $question = Questions::where('account_id', $account->id)->where('id', $id)->orderBy('order', 'ASC')->orderBy('id', 'ASC')->first();
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

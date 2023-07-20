<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewEstimate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $price;
    protected $estimateId;
    protected $name;

    public function __construct($price, $estimateId, $name)
    {
        $this->price = $price;
        $this->estimateId = $estimateId;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('mail.NewEstimate')->with('price',$this->price)->with('name',$this->name)->with('estimateId',$this->estimateId)->subject("New Estimate");
    }
}

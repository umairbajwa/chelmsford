<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostCodeEmail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->isAdmin){
            return $this->view('mail.AdminPostCodeMail')->subject("Postcode outside our vicinity");
        }else{
            return $this->view('mail.PostCodeMail')->subject("Postcode outside our vicinity");
        }
    }
}

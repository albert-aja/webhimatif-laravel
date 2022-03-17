<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData){
        $this->mailData = $mailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        $this->data['name']     = ['name' => __('global.name')];
        $this->data['token']    = $this->mailData['token'];
        $this->data['expired']  = $this->mailData['expired'];

        return $this->subject($this->mailData['subject'])
                    ->view('email.activation_email', $this->data);
    }
}

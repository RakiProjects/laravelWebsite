<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailSend extends Mailable
{
    use Queueable, SerializesModels;

   
    public $data = [];

    public function __construct(array $mail)
    {
        $this->data = $mail;
    }

 

    public function build()
    {
        return $this->from($this->data['email'])
                    ->subject("Tasne 'Daisy', poruka sa sajta: {$this->data['headline']}")
                    ->view('emails.contactEmail', $this->data);
    }
}

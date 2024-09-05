<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $descrition;

    /**
     * Create a new message instance.
     *
     * @param  array  $data
     * @return void
     */
    public function __construct($data)
    {
        // Casting data to strings and logging types
        $this->name = (string) $data['name'];
        $this->email = (string) $data['email'];
        $this->descrition = (string) $data['message'];

        \Log::info('ContactFormMail Data:', [
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->descrition,
            'name_type' => gettype($this->name),
            'email_type' => gettype($this->email),
            'message_type' => gettype($this->descrition),
        ]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contact');
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewMemberRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $memberData;

    /**
     * Create a new message instance.
     */
    public function __construct($memberData)
    {
        $this->memberData = $memberData;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Akun SPI POLIJE Anda Telah Dibuat')
                    ->view('emails.new-member-registered');
    }
}
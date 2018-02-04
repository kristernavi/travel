<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationConfirm extends Mailable
{
    public $book;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($book)
    {
        $this->book = $book;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reservation.confirm');
    }
}

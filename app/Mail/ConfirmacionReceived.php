<?php

namespace App\Mail;

use App\Assignment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Reservation;

class ConfirmacionReceived extends Mailable
{
    use Queueable, SerializesModels;
    public $assignment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Assignment $assignment)
    {
        $this->assignment = $assignment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.confirmacion');
    }
}

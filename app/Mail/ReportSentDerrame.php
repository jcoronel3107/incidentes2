<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Derrame;

class ReportSentDerrame extends Mailable
{
    use Queueable, SerializesModels;
    public $derrame;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Derrame $derrame)
    {
        $this->derrame = $derrame;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.derrame');
    }
}

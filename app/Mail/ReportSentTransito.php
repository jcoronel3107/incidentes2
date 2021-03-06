<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Transito;

class ReportSentTransito extends Mailable
{
    use Queueable, SerializesModels;
    public $transito;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Transito $transito)
    {
        $this->transito = $transito;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.transito');
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Incendio;

class ReportSentIncendio extends Mailable
{
    use Queueable, SerializesModels;
    public $incendio;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Incendio $incendio)
    {
        $this->incendio = $incendio;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.incendio');
    }
}

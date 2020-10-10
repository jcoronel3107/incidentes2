<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Clave;

class ReportSentClave extends Mailable
{
    use Queueable, SerializesModels;
    public $clave;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Clave $clave)
    {
       $this->clave = $clave;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.clave');
    }
}

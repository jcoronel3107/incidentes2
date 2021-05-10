<?php

namespace App\Mail;

use App\Movilizacion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportSentPrevencion extends Mailable
{
    use Queueable, SerializesModels;
    public $movilizacion;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Movilizacion $movilizacion)
    {
        $this->movilizacion = $movilizacion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.prevencion');
    }
}

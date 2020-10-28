<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Servicio;
class ReportSentServicio extends Mailable
{
    use Queueable, SerializesModels;
    public $servicio;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Servicio $servicio)
    {
        $this->servicio = $servicio;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.servicio');
    }
}

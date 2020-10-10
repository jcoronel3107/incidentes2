<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Salud;
class ReportSentSalud extends Mailable
{
    use Queueable, SerializesModels;
    public $salud;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Salud $salud)
    {
         $this->salud = $salud;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.salud');
    }
}

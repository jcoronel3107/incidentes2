<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Inundacion;

class ReportSentInundacions extends Mailable
{
    use Queueable, SerializesModels;
    public $inundacion;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Inundacion $inundacion)
    {
        $this->inundacion = $inundacion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.inundacion');
    }
}

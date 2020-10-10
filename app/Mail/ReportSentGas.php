<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Fuga;

class ReportSentGas extends Mailable
{
    use Queueable, SerializesModels;
    public $fuga;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Fuga $fuga)
    {
        $this->fuga = $fuga;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.fuga');
    }
}

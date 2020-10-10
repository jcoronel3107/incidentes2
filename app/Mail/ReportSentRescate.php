<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Rescate;

class ReportSentRescate extends Mailable
{
    use Queueable, SerializesModels;
    public $rescate;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Rescate $rescate)
    {
        $this->rescate = $rescate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.rescate');
    }
}

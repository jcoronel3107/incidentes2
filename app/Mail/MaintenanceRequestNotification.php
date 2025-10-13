<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Maintenance_request;

class MaintenanceRequestNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $maintenance_request;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Maintenance_request $maintenance_request)
    {
        $this->maintenance_request = $maintenance_request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.maintenancerequestnotification');
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivityLogReport extends Mailable
{
    use Queueable, SerializesModels;

    public $logs;

    public function __construct($logs)
    {
        $this->logs = $logs;
    }

    public function build()
    {
        return $this->subject('Activity Logs')
                    ->view('emails.activity_log_report')
                    ->with(['logs' => $this->logs]);
    }
}

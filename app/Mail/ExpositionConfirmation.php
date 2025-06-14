<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExpositionConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $companyName;
    public $contactPerson;
    public $date;
    public $turn;
    public $startTime;
    public $endTime;

    public function __construct($companyName, $contactPerson, $date, $turn, $startTime, $endTime)
    {
        $this->companyName = $companyName;
        $this->contactPerson = $contactPerson;
        $this->date = $date;
        $this->turn = $turn;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    public function build()
    {
        return $this->subject('Confirmación de exposición')
            ->view('emails.exposition-confirmation');
    }
}

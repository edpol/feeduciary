<?php

namespace feeduciary\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Verification extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->subject=$data["subject"];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $scheme = scheme();
        return $this->subject($this->subject)->markdown('emails.verification')->with("data",$this->data);
    }
}

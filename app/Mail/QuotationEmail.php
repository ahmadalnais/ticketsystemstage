<?php

namespace App\Mail;

use App\Quotation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuotationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $quotation;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Quotation $quotation)
    {
        $this->quotation = $quotation;
        $this->user = $quotation->project->user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.quotationemail');
    }
}

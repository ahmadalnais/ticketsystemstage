<?php

namespace App\Mail;

use App\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $reply;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reply $reply)
    {
        return $this->reply = $reply;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reply-created');
    }
}

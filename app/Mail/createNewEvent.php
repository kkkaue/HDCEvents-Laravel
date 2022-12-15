<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\User;

class createNewEvent extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $user = auth()->user();
        $this->user = $user;

        $event = $user->event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        $this->subject(subject: 'Novo evento foi criado!');
        $this->to($this->user->email, $this->user->name);
        return $this->view('emails.createNewEvent', [
            'user' => $this->user
        ]);
    }
}

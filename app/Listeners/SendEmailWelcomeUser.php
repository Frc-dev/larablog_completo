<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailWelcomeUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return void
     */
    private $event;

    public function handle(UserCreated $event)
    {
        $data['title'] = "Hola amigo". $event->user->name;

        $this->event = $event;

        Mail::send('emails.email', $data, function($message){
            $message->to($this->event->user->email, $this->event->user->name)
                ->subject("Gracias por escribirnos, ". $event->user->name);
        });
    }
}

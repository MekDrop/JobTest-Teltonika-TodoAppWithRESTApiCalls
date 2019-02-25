<?php
namespace App\Listeners;
use App\Events\ExampleEvent;
use App\Events\UserRegisteredEvent;
use App\Mail\RegisteredMail;
use Illuminate\Support\Facades\Mail;

class UserRegisteredListener
{
    /**
     * Handle the event.
     *
     * @param  UserRegisteredEvent  $event
     */
    public function handle(UserRegisteredEvent $event)
    {
        $user = $event->getUser();

        Mail::to([$user->email])->send(
            new RegisteredMail($user)
        );
    }
}
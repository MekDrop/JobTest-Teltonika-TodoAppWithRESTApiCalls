<?php


namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Mail definition for registered user
 *
 * @package App\Mail
 */
class RegisteredMail extends Mailable
{

    use Queueable, SerializesModels;

    /**
     * Related user
     *
     * @var User
     */
    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('mail.registered')
            ->with('url', url('/change-password/' . $this->user->chash));
    }

}
<?php
namespace App\Events;

use App\User;

class UserRegisteredEvent extends Event
{
    /**
     * Related user
     *
     * @var User
     */
    protected $user;

    /**
     * Constructor.
     *
     * @param User $user Related user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
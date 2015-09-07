<?php

namespace Jenky\LaravelNotification;

class UserManager implements Contracts\User
{
    /**
     * User entry.
     * 
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $user;

    public function __construct()
    {
    }
}

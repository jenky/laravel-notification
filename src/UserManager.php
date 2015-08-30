<?php

namespace Jenky\LaravelNotification;

use Illuminate\Database\Eloquent\Model;

class UserManager implements Contracts\User
{
    /**
     * User entry
     * 
     * @var \Illuminate\Database\Eloquent\Model
     */ 
    protected $user;

    public function __construct()
    {

    }
}
<?php

namespace Jenky\LaravelNotification\Contracts;

interface Provider
{
    /**
     * Mark notifications as read
     * 
     * @param mixed $ids
     * @return void
     */ 
    // public function read($ids);

    /**
     * Mark all notifications as read
     * 
     * @return void
     */ 
    // public function readAll();
}
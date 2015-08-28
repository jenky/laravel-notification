<?php

namespace Jenky\LaravelNotification;

trait Notifable
{
    /**
     * @Relation
     */
    public function notifications()
    {
        return $this->hasMany(Models\Alert::class);
    }
}
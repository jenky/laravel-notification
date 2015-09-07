<?php

namespace Jenky\LaravelNotification\Contracts;

interface Factory
{
    /**
     * Set the notification drivers.
     * 
     * @param mixed $drivers
     *
     * @return \Jenky\LaravelNotification\NotificationManager
     */
    public function driver($driver);
}

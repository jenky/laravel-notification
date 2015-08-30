<?php

namespace Jenky\LaravelNotification;

use Illuminate\Support\Manager;

class NotificationManager extends Manager implements Contracts\Factory
{
    /**
     * Get notification messages for user
     * 
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function user($userId)
    {
        return Models\Alert::where('user_id', '=', $userId);            
    }

    public function buildProvider($provider, $config)
    {
        return new $provider($config);
    }

    public function createAlertDriver()
    {
        return $this->buildProvider('Jenky\LaravelNotification\Providers\Alert', 'alert');
    }

    public function createMailDriver()
    {
        return $this->buildProvider('Jenky\LaravelNotification\Providers\Mail', 'mail');
    }

    public function getDefaultDriver()
    {
        return config('notification.default');
    }
}
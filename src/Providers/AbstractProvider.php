<?php

namespace Jenky\LaravelNotification\Providers;

use Jenky\LaravelNotification\Contracts\Provider as ProviderContract;

abstract class AbstractProvider implements ProviderContract
{
    /**
     * Config key
     * 
     * @var string
     */ 
    protected $config;    

    /**
     * @var string
     */
    protected $view; 

    /**
     * @var int
     */
    protected $from; 

    /**
     * @var int
     */
    protected $to;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * Create a new provider instance.
     * 
     * @param string $config
     * @return void
     */ 
    public function __construct($config)
    {
        $this->config = strval($config);
    }

    /**
     * Set the sender id
     * 
     * @param int $id
     * @return \Jenky\LaravelNotification\Providers\AbstractProvider
     */
    public function from($id) 
    {
        $this->from = $id;

        return $this;
    }

    /**
     * Set the receiver id
     * 
     * @param int $id
     * @return \Jenky\LaravelNotification\Providers\AbstractProvider
     */
    public function to($id) 
    {
        $this->to = $id;

        return $this;
    }

    /**
     * Set the notification message.
     * 
     * @return \Jenky\LaravelNotification\Providers\AbstractProvider
     */ 
    abstract public function message();

    /**
     * Send the notification
     * 
     * @return void
     */ 
    abstract public function send();

    protected function getConfig($key)
    {
        return config("notification.drivers.{$this->config}.{$key}");
    }
}
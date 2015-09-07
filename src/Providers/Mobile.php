<?php

namespace Jenky\LaravelNotification\Providers;

use Davibennun\LaravelPushNotification\PushNotification;

class Mobile extends AbstractProvider
{
    /**
     * @var \Davibennun\LaravelPushNotification\PushNotification
     */
    protected $push;

    /**
     * @var array
     */
    protected $appConfig;

    /**
     * @var \Sly\NotificationPusher\Model\Message
     */
    protected $message;

    public function __construct($config)
    {
        parent::__construct($config);

        $this->push = new PushNotification();
    }

    /**
     * {@inheritdoc}
     */
    public function message()
    {
        $params = func_get_args();

        $message = isset($params[0]) ? $params[0] : '';
        $options = isset($params[1]) ? $params[1] : [];

        $this->message = $this->push->Message($message, $options);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function send()
    {
        $to = is_array($this->to) ? $this->device($this->to) : $this->to;

        return $this->push->app($this->appConfig)
            ->to($to)
            ->send($this->message);
    }

    /**
     * Set the app config.
     * 
     * @param mixed $appName
     *
     * @return \Jenky\LaravelNotification\Providers\Mobile
     */
    public function app($appName)
    {
        $this->appConfig = is_array($appName) ? $appName : $this->getConfig($appName);

        return $this;
    }

    /**
     * Set the device tokens.
     * 
     * @param mixed $device
     *
     * @return \Jenky\LaravelNotification\Providers\Mobile
     */
    public function device($device)
    {
        if (is_array($device)) {
            $devices = [];

            foreach ($device as $_device) {
                $devices[] = $this->push->Device($_device['token'], $_device['options']);
            }

            return $this->push->DeviceCollection($devices);
        }

        return;
    }
}

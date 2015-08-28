<?php

namespace Jenky\LaravelNotification\Contracts;

interface Factory
{
    /**
     * Set the notification drivers
     * 
     * @param mixed $drivers
     * @return \Jenky\LaravelNotification\NotificationManager
     */ 
    public function with($driver);

    /**
     * Create notification entry
     * 
     * @param string $contentType
     * @param int $contentId
     * @param string $view
     * 
     * @return \Jenky\LaravelNotification\NotificationManager
     */ 
    public function make($contentType, $contentId, $view = 'default');

    /**
     * Set the sender id
     * 
     * @param int $id
     * @return \Jenky\LaravelNotification\NotificationManager
     */
    public function from($id);

    /**
     * Set the receiver id
     * 
     * @param int $id
     * @return \Jenky\LaravelNotification\NotificationManager
     */
    public function to($id);

    /**
     * Set extra data
     * 
     * @param array $data
     * @return \Jenky\LaravelNotification\NotificationManager
     */
    public function extra(array $data);
    
    /**
     * Send the alert
     * 
     * @param int $form
     * @param int $to
     * @param array $data
     * @return void
     */ 
    public function send($from, $to, array $data = []);

    /**
     * Get notification messages for user
     * 
     * @param int $userId
     * @return \Jenky\LaravelNotification\NotificationManager
     */
    public function user($userId);
}
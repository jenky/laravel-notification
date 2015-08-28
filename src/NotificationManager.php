<?php

namespace Jenky\LaravelNotification;

use Illuminate\Foundation\Application;

class NotificationManager implements Contracts\Factory
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Notification drivers
     * 
     * @var array
     */ 
    protected $drivers = [];

    /**
     * @var string
     */ 
    protected $contentType;

    /**
     * @var int
     */ 
    protected $contentId;

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
    protected $data;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Set the notification drivers
     * 
     * @param mixed $drivers
     * @return \Jenky\LaravelNotification\NotificationManager
     */ 
    public function with($drivers)
    {
        $drivers = is_array($drivers) ? $drivers : func_get_args();

        if (!$drivers) {
            $drivers = config('notification.default');
        }

        $this->drivers = $drivers;

        return $this;
    }  

    /**
     * Create notification entry
     * 
     * @param string $contentType
     * @param int $contentId
     * @param string $view
     * @return \Jenky\LaravelNotification\NotificationManager
     */ 
    public function make($contentType, $contentId, $view = 'default')
    {
        $this->contentType = $contentType;
        $this->contentId = $contentId;
        $this->view = $view;

        return $this;
    }

    /**
     * Set the sender id
     * 
     * @param int $id
     * @return \Jenky\LaravelNotification\NotificationManager
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
     * @return \Jenky\LaravelNotification\NotificationManager
     */
    public function to($id) 
    {
        $this->to = $id;

        return $this;
    }

    /**
     * Set extra data
     * 
     * @param array $data
     * @return \Jenky\LaravelNotification\NotificationManager
     */
    public function extra(array $data) 
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Send the alert
     * 
     * @param int $form
     * @param int $to
     * @param array $data
     * @return void
     */ 
    public function send($from = null, $to = null, array $data = [])
    {
        if (!is_null($from)) {
            $this->from = $from;
        }

        if (!is_null($to)) {
            $this->to = $to;
        }

        if (!empty($data)) {
            $this->data = $data;
        }

        return $this->save();
    }

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

    /**
     * Save the entry to the database
     * 
     * @return bool
     */
    protected function save()
    {
        $data = [
            'user_id'         => $this->from,
            'alerted_user_id' => $this->to,
            'content_type'    => $this->contentType,
            'content_id'      => $this->contentId,
            'view'            => $this->view,
            'extra_data'      => $this->data,
            'driver'          => $this->drivers,
        ];

        $validator = $this->app['validator']->make($data, Models\Alert::$rules);

        if ($validator->fails()) {
            return false;
        }

        return Models\Alert::create($data);
    }
}
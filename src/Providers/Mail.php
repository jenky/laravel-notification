<?php

namespace Jenky\LaravelNotification\Providers;

class Mail extends AbstractProvider
{
    /**
     * Email subject
     * 
     * @var string
     */ 
    protected $subject;

    /**
     * {@inheritdoc}
     */ 
    public function message()
    {
        $params = func_get_args();

        $this->subject = $params[0];
        $this->view = $params[1];

        if (isset($params[2])) {
            $this->data = $params[2];
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */ 
    public function send()
    {        
        app('mailer')->send($this->view, $this->data, function($message)
        {
            if (is_array($this->to)) {
                list($email, $name) = $this->to;
                $message->to($email, $name);
            } else {
                $message->to($this->to);
            }

            $message->subject($this->subject);
        });
    }
}
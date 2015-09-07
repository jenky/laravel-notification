<?php

namespace Jenky\LaravelNotification\Providers;

class Mail extends AbstractProvider
{
    /**
     * Email subject.
     * 
     * @var string
     */
    protected $subject;

    /**
     * Set the email subject.
     * 
     * @return \Jenky\LaravelNotification\Providers\Mail
     */
    public function subject($subject)
    {
        $this->subject = strval($subject);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function message()
    {
        $params = func_get_args();

        $this->view = $params[0];

        if (isset($params[1])) {
            $this->data = $params[1];
        }

        if (isset($params[2])) {
            $this->subject = $params[2];
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function send()
    {
        app('mailer')->send($this->view, $this->data, function ($message) {
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

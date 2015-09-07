<?php

namespace Jenky\LaravelNotification\Providers;

use Jenky\LaravelNotification\Models\Alert as AlertModel;

class Alert extends AbstractProvider
{
    /**
     * @var string
     */
    protected $contentType = '';

    /**
     * @var int
     */
    protected $contentId = 0;

    /**
     * Set the content for the alert.
     * 
     * @param string $contentType
     * @param int    $contentId
     *
     * @return \Jenky\LaravelNotification\Providers\Alert
     */
    public function content($contentType, $contentId)
    {
        $this->contentType = strval($contentType);
        $this->contentId = intval($contentId);

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

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function send()
    {
        $data = [
            'user_id'         => $this->from,
            'alerted_user_id' => $this->to,
            'content_type'    => $this->contentType,
            'content_id'      => $this->contentId,
            'view'            => $this->view,
            'extra_data'      => $this->data,
        ];

        $validator = app('validator')->make($data, AlertModel::$rules);

        if ($validator->fails()) {
            return false;
        }

        return AlertModel::create($data);
    }
}

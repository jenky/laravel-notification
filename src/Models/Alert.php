<?php

namespace Jenky\LaravelNotification\Models;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'alerts';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'extra_data' => 'array',
    ];

    /**
     * Validation rules.
     * 
     * @return array
     */
    public static $rules = [
        'user_id'         => 'integer',
        'alerted_user_id' => 'required|integer',
    ];

    /**
     * @Relation
     */
    public function content()
    {
        return $this->morphTo();
    }

    /**
     * @Relation
     */
    public function user()
    {
        return $this->belongsTo(App\User::class);
    }

    /**
     * @Relation
     */
    public function sender()
    {
        return $this->belongsTo(config('notification.model'), 'user_id');
    }

    /**
     * @Relation
     */
    public function receiver()
    {
        return $this->belongsTo(config('notification.model'), 'alerted_user_id');
    }

    /**
     * Filter all read alerts.
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRead($query)
    {
        return $query->whereNotNull('viewed_at');
    }

    /**
     * Filter all unread alerts.
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnread($query)
    {
        return $query->whereNull('viewed_at');
    }

    /**
     * Render alert.
     * 
     * @param string $view
     * @param array  $data
     *
     * @return string
     */
    public function view($view = null, array $data = [])
    {
        $view = $view ? $view : 'notification::alert_'.$this->getAttribute('view');

        $data['notification'] = $this;
        $data['sender'] = $this->sender;
        $data['receiver'] = $this->receiver;
        $data['content'] = $this->getContent();
        $data['extra'] = $this->getAttribute('extra_data');

        return view($view, $data);
    }

    /**
     * Get the alert's content.
     * 
     * @return mixed
     */
    protected function getContent()
    {
        $contentType = $this->getAttribute('content_type');
        $contentId = $this->getAttribute('content_id');

        if ($contentType && $contentId) {
            return with(new $contentType())->find($contentId);
        }

        return;
    }
}

<?php

namespace Jenky\LaravelNotification;

trait Notifiable
{
    protected $alerts;

    /**
     * @Relation
     */
    public function notifications()
    {
        return $this->hasMany(Models\Alert::class);
    }

    /**
     * Get notification builder.
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function notification()
    {
        return Models\Alert::where('user_id', '=', $this->getAttribute('id'));
    }
}

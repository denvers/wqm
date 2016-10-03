<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Url extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url', 'is_external', 'monitors_id'
    ];

    public function monitor()
    {
        return $this->belongsTo('App\Monitor', 'monitors_id');
    }
}

<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Monitor extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function urls()
    {
        return $this->hasMany('App\Url', 'monitors_id');
    }

    public function qualitychecks()
    {
        return $this->belongsToMany('App\QualityCheck');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'username', 'email', 'password',
    ];

    public function user()
    {
        return $this->belongsToMany('App\User');
    }
}

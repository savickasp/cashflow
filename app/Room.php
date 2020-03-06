<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'owner_id', 'name', 'invite_code', 'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->belongsToMany('App\User', 'games');
    }
}

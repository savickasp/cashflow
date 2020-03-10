<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'game_id',
        'name',
        'cash_flow',
        'quantity',
        'price',
        'down_payment',
    ];
}

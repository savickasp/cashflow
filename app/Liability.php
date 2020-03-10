<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liability extends Model
{
    protected $fillable = [
        'game_id',
        'name',
        'cash_flow',
        'child_number',
        'loan_size',
    ];
}

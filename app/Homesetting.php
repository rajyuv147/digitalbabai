<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homesetting extends Model
{
    protected  $fillable = [
        'key',
        'value',
        'type',
        'user_id',
        'status',
    ];
}

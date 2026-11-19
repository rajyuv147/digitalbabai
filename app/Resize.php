<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resize extends Model
{
    protected $fillable = [
        'section',
        'size'
    ];
}

<?php

namespace App\Models;

use App\Imagedetail;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'position',
        'title',
        'type',
        'content',
        'user_id',
        'status',
    ];

    public function Imagedetails(){
        return $this->hasMany(Imagedetail::class,'section_id');
    }
}

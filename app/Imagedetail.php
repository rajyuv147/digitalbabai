<?php

namespace App;

use App\Models\Section;
use Illuminate\Database\Eloquent\Model;

class Imagedetail extends Model
{
    protected $fillable = ['section_id', 'file_details'];

    public function Section()
    {
        return $this->belongsTo(Section::class);
    }
}

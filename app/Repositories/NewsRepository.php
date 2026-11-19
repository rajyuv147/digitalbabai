<?php

namespace App\Repositories;


use App\Models\News;
use Illuminate\Support\Facades\Auth;

class NewsRepository extends BaseRepository
{
    const Model = News::class;

    public function create(array $data)
    {
        $data['user_id'] = Auth::user()->id;
        parent::create($data);
    }
}
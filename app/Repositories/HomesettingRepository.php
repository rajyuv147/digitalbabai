<?php

namespace App\Repositories;

use App\Homesetting;
use Illuminate\Support\Facades\Auth;
use App\File;

class HomesettingRepository extends BaseRepository
{
    const Model = Homesetting::class;

    public function create(array $data)
    {
        $data['user_id'] = Auth::user()->id;
        $textReady = str_replace(' ', '_', $data['key']);
        $dataget = Homesetting::where('key', $textReady)->get();
        $c = 1;
        while (!$dataget->isEmpty()) {
            $textReady = $textReady.'_'.$c;
            $dataget = Homesetting::where('key', $textReady)->get();
            $c++;
        }
        $data['key'] = $textReady;

        if ($data['type'] == "Image") {
            $data['value'] = url('storage/' . request()->file('content')->store('files'));
        }
        parent::create($data);
    }

    function update(array $data, $id)
    {
        if ($data['type'] == "Image") {
            $data['value'] = url('storage/' . request()->file('content')->store('files'));
        }
        parent::update($data, $id);
    }

//    public function generateKey(){
//            $textReady = str_replace(' ', '_', $data['key']);
//            $data['key'] = $textReady ;
//            if(!$dataget->isEmpty()){
//                $c++;
//                $data['key'] = $textReady .'_'+2;
//            }else{
//                dd(false);
//            }
//        }

}

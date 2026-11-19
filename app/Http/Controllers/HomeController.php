<?php

namespace App\Http\Controllers;

use App\Homesetting;
use App\Imagedetail;
use App\Models\News;
use App\Models\Section;
use App\Resize;
use App\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
    //    {
    //        $this->middleware('auth');
    //    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section1 = Section::where('position', 1)->where('status', '1')->orderBy('id', 'DESC')->with('Imagedetails')->get();
        $section2 = Section::where('position', 2)->where('status', '1')->orderBy('id', 'DESC')->with('Imagedetails')->get();
        $section3 = Section::where('position', 3)->where('status', '1')->orderBy('id', 'DESC')->with('Imagedetails')->get();
        $getSec = Resize::All();
        $sec3 = 100 - $getSec[1]['size'];
        $mytime = date('Y-m-d');
        $views= News::whereDate('start_date','<=',$mytime)
            ->whereDate('end_date','>=',$mytime)
            ->get();
        $getTitle = Homesetting::where('key','name_of_office')->first();
        $getLogo = Homesetting::where('key','logo_for_digital_notice')->first();
        $sendTitle = $getTitle->value;
        $sendLogo = $getLogo->value;

        return view('welcome', compact('views', 'section1', 'section2', 'section3', 'getSec', 'sec3','sendTitle','sendLogo'));
    }

    public function setScreen(Request $request)
    {
        $section = $request->section;
        switch ($section) {
            case 1:
                $value = $request->sendWidth;
                break;
            case 2:
                $value = $request->sendHeight;
                break;
        }
        Resize::where('id', $section)->update(['size' => $value]);
    }
}

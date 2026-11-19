<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Repositories\NewsRepository;
use App\Repositories\SectionRepository;

class DashboardController extends Controller
{
    protected $repoNews;
    protected $repoSection;

    protected $viewSetting = "admin.dashboard.";
    protected $urlSetting = "admin/sections/";
    protected $nameSetting = "Setting";

    public function __construct(NewsRepository $repoNews, SectionRepository $repoSection)
    {
        $this->repoNews = $repoNews;
        $this->repoSection = $repoSection;
        view()->share('viewSetting', $this->viewSetting);
        view()->share('urlSetting', $this->urlSetting);
        view()->share('nameSetting', $this->nameSetting);
    }

    public function index()
    {
        $getValue = \App\Resize::All();
        $width = $getValue[0]['size'];
        $height = $getValue[1]['size'];
        $sec3 = 100 - $getValue[0]['size'];

        $countNews = $this->repoNews->count();
        $countSection = $this->repoSection->count();

        $items = Section::latest()->with('Imagedetails')->get();
        return view('admin.dashboard.index', compact('views', 'countNews', 'countSection', 'width', 'height', 'sec3', 'items'));
    }
}

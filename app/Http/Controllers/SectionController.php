<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSection;
use App\Http\Requests\UpdateSection;
use App\Models\Section;
use App\Repositories\SectionRepository;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SectionController extends Controller
{
    protected $view = "admin.setting.";
    protected $url = "admin/sections/";
    protected $name = "Setting";
    protected $repo;

    public function __construct(SectionRepository $repo)
    {
        $this->middleware('auth');
        $this->repo = $repo;
        view()->share('view', $this->view);
        view()->share('url', $this->url);
        view()->share('name', $this->name);
    }

    public function index()
    {
        $items = $this->repo->all();
        return view($this->view . 'index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getValue = \App\Resize::All();
        $width = $getValue[0]['size'];
        $height = $getValue[1]['size'];
        $sec3 = 100 - $getValue[0]['size'];
        return view($this->view . 'test', compact('width', 'height', 'sec3'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addItem(CreateSection $request){
        $this->repo->create(\request()->all());
        return $request;
    }

    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required',
            'type' => 'required',
            'content' => 'required',
        ]);

        $id = $this->repo->create(\request()->all());
        return array_merge($request->all(), ['id' => $id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = $this->repo->show($id);
        return view('admin.dashboard.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Section::where('id',$id)->with('Imagedetails')->get();
        return $item;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSection $request, $id)
    {
        $this->repo->update(\request()->all(), $id);
        return array_merge($request->all(), ['id' => $id]);
    }

//    public function updateSection(UpdateSection $request,$id)
//    {
//        $this->repo->update(\request()->all(), $id);
//        return $id;
//    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repo->delete($id);
        return $id;
    }
}

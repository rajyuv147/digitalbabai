<?php

namespace App\Http\Controllers;

use App\Repositories\HomesettingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomesettingController extends Controller
{
    protected $view = "admin.homesetting.";
    protected $url = "admin/homesetting/";
    protected $name = "Home Setting";
    protected $repo;

    public function __construct(HomesettingRepository $repo)
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
        return view($this->view . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->repo->create(\request()->all());
        Session::flash('success', $this->name . ' Entered !!!');
        return redirect($this->url);
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
        return view($this->view . 'show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->repo->show($id);
        return view($this->view . 'edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->repo->update(\request()->all(), $id);
        Session::flash('success', $this->name . ' Updated !!!');
        return redirect($this->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repo->delete($id);
        Session::flash('success', $this->name . ' Deleted !!!');
        return redirect($this->url);
    }
}

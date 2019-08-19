<?php

namespace App\Http\Controllers\Backend\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Feature;

class FeatureController extends AdminParentController
{
    public function index()
    {
        $features = Feature::orderBy('id')->paginate($this->displayNumber);
        return view('backend.admin.feature.index', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Feature $feature)
    {
        return view('backend.admin.feature.create', compact('feature'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:tags,name,'.$id,
        ]);
        $tag = new Tag;
        $tag->name = request('name');
        $tag->save();
        return redirect('/backend/admin/feature')->with('success', 'Feature updated');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feature = Feature::findOrFail($id);
        return view('backend.admin.feature.edit', compact('feature'));
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
        $feature = Feature::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|unique:tags,name,'.$id,
        ]);
        $tag->name = request('name');
        $tag->update();
        return redirect('/backend/admin/feature')->with('success', 'Feature updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feature = Feature::findOrFail($id)->delete();
        return redirect('/backend/admin/feature')->with('success', 'Feature removed');

    }
}


<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Track;
use App\Feature;
use App\Notifications\FeaturedTrack;
use Auth;
class WeeklyTrackController extends AdminParentController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tracks = Track::with('owner')->notFeatured()->weekly()->get();
        $week = now()->weekOfYear;
        $server = 'http://localhost:8000/';
        // dd(Auth::user());
        // dd($tracks);
        return view('backend.admin.track.weekly.index', compact('tracks', 'week', 'server'));
    }

    /**
     * Store a newly created resource in storage.
     *
    * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $feature = new Feature();
        $feature->feature_type = 'App\Track';
        $feature->feature_id = $request->input('feature_id');
        $feature->save();

        $track = Track::where('id', '=',  $feature->feature_id)->first();
        $track->owner->notify(new FeaturedTrack($track));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $track = Track::findOrFail($id)->delete();
        return redirect('/backend.admin.track.other.index')->with('success', 'Track removed');
    }
}

<?php

namespace App\Http\Controllers\backend\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Track;
use Auth;
class TrackController extends AdminParentController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tracks = Track::with('owner', 'featured')->featured()->orderBy('created_at', 'desc')->get();
        $week = now()->weekOfYear;
        $server = 'http://localhost:8000/';
        return view('backend.admin.track.other.index', compact('tracks', 'week', 'server'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $track = Track::findOrFail($id);
        $track->featured()->where('feature_id', '=', $id)->delete();
        $track->delete();
        return redirect()->back()->with('success', 'Track removed');
    }
}

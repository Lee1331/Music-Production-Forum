<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Track;
use DB;

//testing
use Illuminate\Support\Facades\Input;
use App\User;

class TrackArchivesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $server = 'http://localhost:8000/';
        $tracks = Track::getTrackArchives();

        //get all the tracks in each week
        $tracksByWeek = Track::getWeeklyTrackArchives();

        $weeklyTrackCount = $tracksByWeek->reduce(function ($count, $tracks) {
            return $count + $tracks->count();
        }, 0);

        return view('track.archives.index', compact('server', 'tracksByWeek', 'weeklyTrackCount','tracks'));
    }

}

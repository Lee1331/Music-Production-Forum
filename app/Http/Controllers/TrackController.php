<?php

namespace App\Http\Controllers;

use App\Track;
use Illuminate\Http\Request;
use Auth;
class TrackController extends Controller
{

    public function __construct(){
        //restrict access to create unless the user is logged in
        $this->middleware('verified')->only('create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $startDate = now()->startOfWeek();
        $endDate =  now()->endOfWeek();
        $tracks = Track::with('owner')->featured()->weekly()->get();
        $week = now()->weekOfYear;
        $server = 'http://localhost:8000/';

        return view('track.index', compact('tracks', 'week', 'server'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('track.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $track = new Track();

        $this->validate($request, [
            'title' => 'required',
            'genre' => 'required|min:3',
            'track' => 'required|mimetypes:audio/ogg|max:800000',
            //for now we are only supporting .ogg files as some browsers seems to have issues with .wav and .mp3 (mpga) files
            //'track' => 'required|mimes:audio,mpga,wav|max:800000',
        ]);

        $track->title = $request->input('title');
        $track->artist_id = auth()->id();
        $track->genre = $request->input('genre');
        $track->track = $track->addTrack($request);
        $track->created_at = now();
        $track->save();
        return redirect('track')->with('success', 'track submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function show(Track $track)
    {
        $user = Auth::user();
        $tracks = Track::with('owner')->featured()->artist($user->id)->get();
        $server = 'http://localhost:8000/';

        return view('user.tracks.show', compact('user', 'tracks', 'server'));
    }

}

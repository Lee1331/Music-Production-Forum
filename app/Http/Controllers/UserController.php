<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\LikeForumPost;
use App\Track;
class UserController extends Controller
{
    /**
     * Display the selected users threads.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $threads = $user->forumThreads()->orderBy('created_at')->paginate(10);
        return view('backend.user.show',compact('user', 'threads'));
    }

    /**
     * Display the selected users likes.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function likes(User $user)
    {
        $likes = LikeForumPost::with('forumPost')->where('user_id', '=', $user->id)->get();
        return view('backend.user.likes.show', compact('user', 'likes'));
    }

    /**
     * Display the selected users tracks.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function tracks(User $user)
    {
        $tracks = Track::with('featured')->artist($user->id)->get();
        $server = 'http://localhost:8000/';
        return view('backend.user.tracks.show', compact('user', 'tracks', 'server'));
    }
}

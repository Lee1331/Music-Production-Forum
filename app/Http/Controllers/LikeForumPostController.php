<?php

namespace App\Http\Controllers;

use App\LikeForumPost;
use App\ForumPost;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\LikedForumPost;
class LikeForumPostController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function index(ForumPost $forumPost)
    public function store(ForumPost $forumPost)
    {
        $forumPost->likeForumPost();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LikeForumPost  $likeForumPost
     * @return \Illuminate\Http\Response
     */
    //public function destroy(LikeForumPost $likeForumPost)
    public function destroy(ForumPost $forumPost)
    {
        $forumPost->dislikeForumPost();
        return redirect()->back();
    }

    public function show()
    {
        $user = Auth::user();
        $likedPosts = $user->getLikedPosts();
        return view('user.likes.show', compact('user', 'likedPosts'));
    }

}

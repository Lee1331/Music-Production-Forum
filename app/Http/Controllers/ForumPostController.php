<?php

namespace App\Http\Controllers;

use App\ForumPost;
use App\ForumThread;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Notifications\RepliedToForumThread;
class ForumPostController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, ForumThread $thread)
    {

        $thread->addForumPost([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => auth()->id(),
            ]);

        if(auth()->user()->id !==  $thread->owner['id']){
            $thread->owner->notify(new RepliedToForumThread($thread));
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ForumThread  $forumThread
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = ForumPost::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Post removed');
    }
}

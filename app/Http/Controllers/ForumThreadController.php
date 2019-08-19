<?php

namespace App\Http\Controllers;

use App\ForumThread;
use App\ForumCategory;
use Illuminate\Http\Request;
use App\Http\Requests\ThreadRequest;
class ForumThreadController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'verified'])->only('store', 'destroy', 'create', 'update', 'edit');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $threads = ForumThread::getThreads();
        return view('forum.thread.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ForumCategory::select('name', 'id')->get();
        return view('forum.thread.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThreadRequest $request)
    {
        //store a thread
        $thread = ForumThread::create([
            'title' => request('title'),
            'body' => request('body'),
            'user_id' => auth()->id(),
            'category_id' => request('category'),
        ]);
        return redirect()->route('forum.show', $thread->title);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ForumThread  $forumThread
     * @return \Illuminate\Http\Response
     */
    public function show(ForumThread $thread)
    {
        $thread->increment('view_count');

        return view('forum.thread.show', compact('thread', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ForumThread  $forumThread
     * @return \Illuminate\Http\Response
     */
    public function edit(ForumThread $thread)
    {
        $categories = ForumCategory::select('name', 'id')->get();
        return view('forum.thread.edit', compact('thread', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ForumThread  $forumThread
     * @return \Illuminate\Http\Response
     */
    public function update(ThreadRequest $request, ForumThread $thread)
    {
        $thread->title = $request->input('title');
        $thread->body = $request->input('body');
        $thread->category_id = $request->input('category');
        $thread->updated_at = now();
        $thread->update();
        return redirect('/home')->with('success', 'Forum thread updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ForumThread  $forumThread
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $thread = ForumThread::findOrFail($id)->delete();
        return redirect('/home')->with('success', 'Thread removed');
    }
}

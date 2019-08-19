<?php

namespace App\Http\Controllers\backend\admin;

use Illuminate\Http\Request;
use App\Http\Requests\ThreadRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\ForumThread;
use App\ForumCategory;

class ForumThreadController extends AdminParentController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Auth::user();
        $threads = ForumThread::orderBy('id')->paginate($this->displayNumber);
        return view('backend.admin.forum.thread.index', compact('admin','threads'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ForumThread $thread)
    {
        $categories = ForumCategory::select('name', 'id')->get();
        return view('backend.admin.forum.thread.edit', compact('thread', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ThreadRequest $request, ForumThread $thread)
    {
        $thread->title = $request->input('title');
        $thread->body = $request->input('body');
        $thread->category_id = $request->input('category');
        $thread->update();
        return redirect('/backend/admin/thread')->with('success', 'Forum thread updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $thread = ForumThread::findOrFail($id)->delete();
        return redirect('/backend/admin/thread')->with('success', 'Thread removed');
    }
}

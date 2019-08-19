<?php

namespace App\Http\Controllers\backend\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ForumPost;

class ForumPostController extends AdminParentController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = ForumPost::orderBy('id')->paginate($this->displayNumber);
        return view('backend.admin.forum.post.index', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = ForumPost::findOrFail($id);
        return view('backend.admin.forum.post.edit', compact('post'));
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
        $post = ForumPost::findOrFail($id);

        $this->validate($request, [
            'title' => 'required',
            'body' =>  'required',
        ]);

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->update();
        return redirect('/backend/admin/post')->with('success', 'Forum post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = ForumPost::findOrFail($id)->delete();
        return redirect('/backend/admin/post')->with('success', 'Forum Post removed');
    }
}

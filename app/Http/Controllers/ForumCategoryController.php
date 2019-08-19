<?php

namespace App\Http\Controllers;

use App\ForumCategory;
use App\ForumThread;
use Illuminate\Http\Request;
class ForumCategoryController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\ForumCategory  $forumCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ForumCategory $forumCategory, Request $request)
    {
        $threads = ForumThread::where('category_id', $forumCategory->id)->get();
        return view('forum.category.show', compact('threads', 'forumCategory'));
    }
}

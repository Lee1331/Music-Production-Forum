<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::with('articles')->articles()->get();
        return view('tag.index', compact('tags'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */

    public function show(Tag $tag)
    {

        $tag->load('articles');

        $trendingArticles = $tag->getTrendingArticles();
        $trendingArticles->load('tags', 'author');
        $count = $trendingArticles->last()->view_count;

        $articles = $tag->articles()->where('articles.view_count', '<', $count)->get();
        $articles->load('author', 'tags');
        return view('tag.show', compact('tag', 'articles', 'trendingArticles'));
    }
}

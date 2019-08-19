<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;
use App\Article;
use App\Tag;
use App\Feature;
use Auth;
class ArticleController extends AdminParentController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with('tags')->orderBy('id')->paginate($this->displayNumber);

        return view('backend.admin.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tags = Tag::select('name', 'id')->get();
        return view('backend.admin.article.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $article = new Article();
        $article->title = $request->input('title');
        $article->excerpt = $request->input('excerpt');
        $article->body = $request->input('body');
        $article->author_id = Auth::guard('admin')->user()->id;

        if($request->hasFile('header_image')){
            $article->header_image = $article->addImage('header_image', $request);
        }
        if($request->hasFile('body_image')){
            $article->body_image = $article->addImage('body_image', $request);
        }
        $article->save();

        $article->tags()->sync($request->tags, false);
        if($article->tags()->where('name', 'Featured')->exists()){
            $feature = new Feature();
            $feature->feature_type = 'App\Article';
            $feature->feature_id = $article->id;
            $feature->save();
        }
        return redirect('/backend/admin/article')->with('success', 'Article Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $tags = Tag::select('name', 'id')->get();
        return view('backend.admin.article.edit', compact('article', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {

        $article->title = $request->input('title');
        $article->excerpt = $request->input('excerpt');
        $article->body = $request->input('body');
        $article->author_id =  Auth::guard('admin')->user()->id;

        if($request->hasFile('header_image')){
            $article->header_image = $article->addImage('header_image', $request);
        }
        if($request->hasFile('body_image')){
            $article->body_image = $article->addImage('body_image', $request);
        }
        $article->update();

        $article->tags()->sync($request->tags, true);

        if($article->tags()->where('name', 'Featured')->exists()){
            $feature = new Feature();
            $feature->feature_type = 'App\Article';
            $feature->feature_id = $article->id;
            $feature->save();
        }
        else if(! $article->tags()->where('name', 'Featured')->exists() && $article->featured()->exists()){
            $article->featured()->delete();
        }

        return redirect('/backend/admin/article')->with('success', 'Article updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->tags()->detach();
        $article->featured()->where('feature_id', '=', $id)->delete();

        $article->delete();

        return redirect('/backend/admin/article')->with('success', 'Article removed');
    }
}

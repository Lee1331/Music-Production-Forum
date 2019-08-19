<?php

namespace App\Http\Controllers\backend\admin;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use App\ForumCategory;
class ForumCategoryController extends AdminParentController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = ForumCategory::with('threads')->orderBy('id')->paginate($this->displayNumber);
        return view('backend.admin.forum.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ForumCategory $category)
    {
        return view('backend.admin.forum.category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new ForumCategory();
        $category->name = request('name');
        $category->save();
        return redirect('/backend/admin/category')->with('success', 'Forum category created');
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
    public function edit(ForumCategory $category)
    {
        return view('backend.admin.forum.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, ForumCategory $category)
    {
        // $this->validate($request, [
        //     'name' => 'required|unique:forum_categories,name,'.$id,
        // ]);

        $category->update([
            'name' => request('name'),
        ]);
        return redirect('/backend/admin/category')->with('success', 'Forum category updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = ForumCategory::findOrFail($id)->delete();
        return redirect('/backend/admin/category')->with('success', 'Category removed');
    }
}

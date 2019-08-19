<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

//viewing personal account
Route::prefix('home')->group(function(){
    Route::get('/', 'HomeController@index')->name('home')->middleware('verified');
    Route::get('/{user}/edit', 'HomeController@edit')->name('home.edit')->middleware('verified');
    Route::put('/{user}/edit', 'HomeController@update')->name('home.update')->middleware('verified');
    Route::get('/tracks', 'TrackController@show')->name('home.tracks.show')->middleware('verified');
    Route::get('/likes', 'LikeForumPostController@show')->name('home.likes.show')->middleware('verified');
    Route::get('/tracks', 'TrackController@show')->name('home.tracks.show')->middleware('verified');
});
// Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
// Route::get('/home/{user}/edit', 'HomeController@edit')->name('home.edit')->middleware('verified');
// Route::put('/home/{user}/edit', 'HomeController@update')->name('home.update')->middleware('verified');
// Route::get('/home/likes', 'LikeForumPostController@show')->name('home.likes')->middleware('verified');
// Route::get('/home/tracks', 'TrackController@show')->name('home.tracks.show')->middleware('verified');

Route::post('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');
Route::get('/user/notifications', 'NotificationController@index')->name('user.notification');

//Viewing other users
Route::prefix('users')->group(function(){
    Route::get('/{user}', 'UserController@show')->name('user.show');
    Route::get('/{user}/likes', 'UserController@likes')->name('user.likes.show');
    Route::get('/{user}/tracks', 'UserController@tracks')->name('user.tracks.show');
});

// /forum/...
Route::prefix('/forum')->group(function(){
    //Threads
    Route::get('/', 'ForumThreadController@index')->name('forum');
    Route::get('/{thread}', 'ForumThreadController@show')->name('forum.show');
    Route::get('/thread/create', 'ForumThreadController@create')->name('forum.create');
    Route::post('/', 'ForumThreadController@store')->name('forum.store');
    Route::delete('/thread/{thread}', 'ForumThreadController@destroy')->name('forum.destroy');
    Route::get('/{thread}/edit', 'ForumThreadController@edit')->name('forum.edit');
    Route::put('/{thread}/update', 'ForumThreadController@update')->name('forum.update');
    //Categories
    Route::get('/category/{forumCategory}', 'ForumCategoryController@show')->name('forum.category.show');
    //Posts
    Route::post('/{thread}/posts', 'ForumPostController@store')->name('forum.posts');
    Route::delete('/{post}', 'ForumPostController@destroy')->name('post.destroy');
    //Post Likes
    Route::post('/{forumPost}/like', 'LikeForumPostController@store')->name('like.post');
    Route::delete('/{forumPost}/like', 'LikeForumPostController@destroy')->name('dislike.post');
});

//tracks
Route::prefix('track')->group(function(){
    Route::resource('/', 'TrackController', [
        'names'    => [
            'index'   => 'track',
            'show'   => 'track.show',
            'create'   => 'track.create',
        ]
    ]);
    Route::resource('/archives', 'TrackArchivesController', [
        'names'    => [
            'index'   => 'track.archives',
        ]
    ]);
});

//article
Route::resource('/articles', 'ArticleController', [
    'names'    => [
        'index'   => 'article',
        'show'   => 'article.show',
    ]
]);
Route::prefix('articles')->group(function(){
    Route::resource('/tags', 'TagController', [
        'names' => [
            'show' => 'tags.show',
        ]
    ]);
});

//Tags
Route::get('/tags', 'TagController@index')->name('tags');

// /admin/...
Route::prefix('admin')->group(function(){
    Route::get('/login', 'Auth\Admin\LoginController@showAdminLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\Admin\LoginController@loginAdmin')->name('admin.login.submit');
    Route::get('/logout', 'Auth\Admin\LoginController@logout')->name('admin.logout');
    Route::get('/', 'AdminController@index')->name('admin.home');
});
// Route::put('/backend/admin/user/{user}/edit', 'Backend\Admin\UserController@update')->name('user.update');

// backend/admin...
Route::prefix('backend/admin')->group(function(){
    Route::resource('/user', 'Backend\Admin\UserController', [
        'names'    => [
            'destroy'   => 'user.destroy',
            //even though this isn't being used, we need to because this will default to 'user.show' which will break the actual user.show route
            'show' => 'admin.user.show',
        ]
    ]);
    Route::resource('/thread', 'Backend\Admin\ForumThreadController', [
        'names'    => [
            'index'   => 'admin.thread.index',
            'create'   => 'admin.thread.create',
        ]
    ]);
    Route::resource('/category', 'Backend\Admin\ForumCategoryController', [
        'names'    => [
            'index'   => 'admin.category.index',
            'edit'   => 'admin.category.edit',
            'destroy'   => 'admin.category.destroy',
            'create'   => 'admin.category.create',
        ]
    ]);
    Route::resource('/post', 'Backend\Admin\ForumPostController', [
        'names'    => [
            'index'   => 'admin.post.index',
            'edit'   => 'admin.post.edit',
            'destroy'   => 'admin.post.destroy',
            'create'   => 'admin.post.create',
        ]
    ]);

    Route::resource('/article', 'Backend\Admin\ArticleController', [
        'names'    => [
            'index'   => 'admin.article.index',
            'create'   => 'admin.article.create',
            'destroy'   => 'admin.article.destroy',
            'edit'   => 'admin.article.edit',
            //even though this isn't being used, we need to because this will default to 'article.show' which will break the actual article.show route
            'show'   => 'admin.article.show',
        ]
    ]);
    Route::resource('/tag', 'Backend\Admin\TagController', [
        'names'    => [
            'index'   => 'admin.tag.index',
            'create'   => 'admin.tag.create',
            'destroy'   => 'admin.tag.destroy',
            'edit'   => 'admin.tag.edit',
            'store'   => 'admin.tag.store',
            //even though this isn't being used, we need to because this will default to 'tag.show' which will break  the actual tag.show route
            'show'   => 'admin.tag.show',
        ]
    ]);

    Route::resource('/track/weekly', 'Backend\Admin\WeeklyTrackController', [
        'names'    => [
            'index'   => 'admin.track.weekly.index',
            'destroy'   => 'admin.track.weekly.destroy',
            'edit'   => 'admin.track.weekly.edit',
            'store'   => 'admin.track.weekly.store',
        ]
    ]);

    Route::resource('/track', 'Backend\Admin\TrackController', [
        'names'    => [
            'index'   => 'admin.track.index',
            'destroy'   => 'admin.track.destroy',
            'create'   => 'admin.track.create',
        ]
    ]);
});

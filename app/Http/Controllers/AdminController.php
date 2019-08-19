<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ForumThread;
use App\ForumPost;
use App\Feature;
use Illuminate\Support\Facades\Auth;
use DB;
class AdminController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    /**
     * Users must be authenticated as an admin to access the routes from this controller.
     * Note that ':' specifies the guard we are using, by defualt the guard is set to 'web'
     *
     * @return void
     */
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $admin = Auth::user();
        $userCount = User::count();
        $postCount = ForumPost::count();
        $threadCount = ForumThread::count();

        $month = now()->month;
        $monthName = now()->format('F');
        $monthlyUserData = DB::table("users")->whereRaw('MONTH(created_at) = ?',[$month])->get()->count();
        $monthlyThreadData = DB::table("forum_threads")->whereRaw('MONTH(created_at) = ?',[$month])->get()->count();
        $monthlyPostData = DB::table("forum_posts")->whereRaw('MONTH(created_at) = ?',[$month])->get()->count();
        $monthlyTrackSubmissions = DB::table("tracks")->whereRaw('MONTH(created_at) = ?',[$month])->get()->count();

        $articleViews = DB::table('articles')->sum('view_count');
        $threadViews = DB::table('forum_threads')->sum('view_count');

        $featuredTracks = Feature::getFeaturedTracks()->count();
        $featuredArticles = Feature::getFeaturedArticles()->count();
        return view('admin.index', compact('admin',
            'userCount', 'postCount', 'threadCount',
            'featuredTracks', 'featuredArticles',
            'articleViews', 'threadViews',
            'monthName', 'monthlyUserData', 'monthlyThreadData', 'monthlyPostData', 'monthlyTrackSubmissions'
        ));
    }
}

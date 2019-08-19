<?php

namespace App\Providers;
use App\ForumThread;
use App\Tag;
use App\Article;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *This method will run on every service provider
     * @return void
     */
    public function boot()
    {
        //set the defualt string field size for the database fields
        Schema::defaultStringLength(191);

        //cache the categories
        view()->composer('partials.categoryNavbar', function($view){
            $categories = \Cache::rememberForever('categories', function () {
                return \App\ForumCategory::getCategories();
            });

            $view->with('categories', $categories);
        });

        view()->composer('partials.userDashboard', function($view){
            $view->with('trendingThreads', ForumThread::getTrendingThreads() );
            $view->with('popularThreads', ForumThread::getPopularThreads() );

        });

        //viewing a users personal account
        view()->composer(['user.home', 'user.likes.show', 'user.tracks.show'], function($view){
            //preload these views with...
            $view->with('threadsRoute', 'home' );
            $view->with('likesRoute', 'home.likes.show' );
            $view->with('tracksRoute', 'home.tracks.show' );
        });
        //viewing another users account
        view()->composer([
            'backend.user.show',
            'backend.user.likes.show', 'backend.user.tracks.show',
            'home.show',
            'backend.user.threads.show'
        ], function($view){
            $user = $view->user_name;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //this will bind data into the service container
    }
}

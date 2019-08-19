<?php

namespace App;
use \App\ForumThread;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use \App\Http\Controllers\Display\ForumThreadDisplay;

class ForumThread extends Model
{
    protected $primaryKey = 'id';
    protected $with = ['owner', 'category'];
    protected $fillable = ['user_id', 'category_id', 'title', 'body'];

    public function getRouteKeyName(){
        return 'title';
    }

    //Relationships
    public function forumPosts(){
        return $this->hasMany(ForumPost::class);
    }

    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(){
        return $this->belongsTo(ForumCategory::class, 'category_id');
    }

    //Functionality
    public function addForumPost($post){
        $this->forumPosts()->create($post);
    }

    public function getCategoryNameAttribute(){
        return $this->category->name;
    }

    public function getOwnerNameAttribute(){
        return $this->owner['name'];
    }

    public function display(){
        return new ForumThreadDisplay($this);
    }

    public static function getThreads(){
        return ForumThread::orderBy('created_at', 'desc')->paginate(10);
    }

    public static function getTrendingThreads(){
        return ForumThread::orderby('view_count', 'desc')->take(5)->get();
    }

    public static function getPopularThreads(){
        return ForumThread::with('forumPosts')->get()->sortByDesc(function($forumThread){
            return $forumThread->forumPosts->count();
        })->take(5);
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use \App\Http\Controllers\Display\ForumPostDisplay;
use Illuminate\Notifications\Notifiable;
use App\Notifications\LikedForumPost;

class ForumPost extends Model{
    use Notifiable;

    protected $with = ['owner','likes', 'forumThread'];
    protected $guarded = [];
    protected $fillable = ['user_id', 'forum_thread_id', 'title', 'body'];

    public function getRouteKeyName(){
        return 'title';
    }

    //Relationships
    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes(){
        return $this->hasMany(LikeForumPost::class, 'forum_post_id');
    }
    public function forumThread(){
        return $this->belongsTo(ForumThread::class);
    }

    public function likeForumPost(){
        //paramaters for the user
        $user = ['user_id' => auth()->id()];

        //if this forum post hasn't already been liked by this user
        if (! $this->likes()->where($user)->exists()) {
            //like the post
            return $this->likes()->create($user);
        }
        if(auth()->user()->id !== $this->owner['id']){
            $this->owner->notify(new LikedForumPost($this));
        }
    }

    public function display(){
        return new ForumPostDisplay($this);
    }

    public function dislikeForumPost(){
        $user = ['user_id' => auth()->id()];
        if ($this->likes()->where($user)->exists()) {
            $this->likes()->where($user)->get()->each->delete();
        }
    }

    public function getLikesCountAttribute(){
        //!! = cast to boolean
        return !! $this->likes->count();
    }

    public function isAlreadyLiked(){
        $user = ['user_id' => auth()->id()];
        return !! $this->likes->where($user)->count();
    }

    public function getLikedPosts(){
        return $this->likes->user();
    }

    public function scopeUser($query){
        $user = ['user_id' => auth()->id()];
        return $query->where($user);
    }
}

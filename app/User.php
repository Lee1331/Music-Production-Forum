<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Auth;
use DB;
use File;
use App\LikeForumPost;
use App\Traits\AddImage;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use AddImage;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user', 'email', 'password', 'bio', 'profile_image', 'name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //override the default routing key - instead of returning the user_id in the url, return their name
    public function getRouteKeyName(){
        return 'name';
    }

    //Relationships
    public function ForumPosts(){
        return $this->hasMany(ForumPost::class);
    }
    public function forumThreads(){
        return $this->hasMany(ForumThread::class);
    }
    public function likePost(){
        return $this->hasMany(LikeForumPost::class);
    }

    //functionality
    public function destroyProfileImage(){
        if($this->profile_image){
            $profileImagePath = 'images/'. $this->profile_image;
            File::delete($profileImagePath);
        }
    }

    public function getLikedPosts(){
        return LikeForumPost::with('forumPost')->where('user_id', '=', $this->id)->get();
    }

    public function getThreads(){
        return $this->forumThreads()->orderBy('created_at')->paginate(10);
    }

}

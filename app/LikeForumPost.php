<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class LikeForumPost extends Model
{
    protected $guarded = [];
    //Relationships
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function forumPost(){
        return $this->belongsTo(ForumPost::class);
    }

}

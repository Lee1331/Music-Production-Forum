<?php

namespace App\Http\Controllers\Display;
use App\ForumPost;

//View Models
class ForumPostDisplay{

    protected $thread;

    public function __construct(ForumPost $post){
        $this->post = $post;
    }

    public function __get($property){
        //check if property exists
        if(\method_exists($this, $property)){
            //if this propery exists on this object, call it and return the result - this will preven us from having to add '()' to any of this classes methods when we use them
                //call_user_func - Calls the callback given by the first parameter and passes the remaining parameters as arguments.
            return call_user_func([$this, $property]);
        }
        else {
            throw new \Exception(static::class . ' does not exist in ' . $property);
        }
    }

    public function formatedCreatedAtDate(){
        return $this->post->created_at->diffForHumans();
    }
    public function formatedUpdatedAtDate(){
        return $this->post->updated_at->diffForHumans();
    }

}
?>

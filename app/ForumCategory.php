<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ForumCategory;
use Illuminate\Database\Eloquent\Builder;
class ForumCategory extends Model
{
    protected $fillable = ['name'];

    public function getRouteKeyName(){
        return 'name';
    }

    //relationships
    public function threads(){
        return $this->hasMany(ForumThread::class, 'category_id');
    }

    //Functionality
    public static function getCategories(){
        return ForumCategory::all();
    }
    public function getThreadCountAttribute(){
        return $this->threads->count();
    }
}

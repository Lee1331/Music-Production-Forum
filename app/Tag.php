<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tag;

class Tag extends Model
{

    protected $fillable = ['name'];

    public function getRouteKeyName(){
        return 'name';
    }

    //Relationships
    public function articles(){
        return $this->belongsToMany(Article::class);
    }

    public function getTrendingArticles(){
        return $this->articles()->orderby('articles.view_count', 'desc')->get()->take(5);
    }

    public function scopeArticles($query){
        return $query->has('articles');
    }
}

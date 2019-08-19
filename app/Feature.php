<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Feature;
use App\Article;
use App\Track;
class Feature extends Model
{
    public function articles(){
        return $this->hasMany(Article::class, 'id');
    }

    public function tracks(){
        return $this->hasMany(Track::class, 'id');
    }

    public function createFeaturedContent($type, $id){
        Feature::create([
            'feature_type' => $type,
            'feature_id' => $id,
        ]);
    }

    public static function getFeaturedTracks(){
        return Track::has('featured');
    }
    public static function getFeaturedArticles(){
        return Article::has('featured');
    }
}

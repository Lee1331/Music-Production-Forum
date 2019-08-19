<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
//use GrahamCampbell\Markdown\Facades\Markdown;
use Carbon\Carbon;

use App\Article;
use App\Traits\AddImage;

class Article extends Model
{
    use Notifiable;
    use AddImage;

    protected $fillable = ['title', 'author_id'];

    public function getRouteKeyName(){
        return 'title';
    }

    //Relationships
    public function author(){
        return $this->belongsTo(Admin::class, 'author_id');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function featured(){
        return $this->hasOne(Feature::class, 'feature_id');
    }

    // public function articleTags(){
    //     return $this->belongsToMany(Tag::class);
    // }
    // public function articleTags(){
    //     return $this->belongsToMany(ArticleTag::class);
    // }

    //Functionality
    public static function getArticles(){
        return Article::with('author', 'tags')->doesntHave('featured')->orderBy('created_at', 'desc')->paginate(10);

    }
    public static function getFeaturedArticles(){
        $startDate = now()->startOfWeek();
        $endDate = now()->endOfWeek();
        $featured = Article::with('author', 'tags')->has('featured')->whereBetween('created_at', [$startDate, $endDate])->inRandomOrder()->get()->take(5);
        return $featured;
    }
}

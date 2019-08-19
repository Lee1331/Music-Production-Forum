<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Article;
use App\Admin;

class ArticleTest extends TestCase
{
    use DatabaseMigrations;

    public function test_that_articles_can_be_created(){
        $admin = factory('App\Admin')->create();
        //$admin = new Admin();

        $data = [
            'title' => 'test',
            'body' => 'this should create a new article',
            'excerpt' => 'test',
            'header_image' => 'test.png',
            'body_image' => 'test.jpg',
            'author_id' => $admin->id,
        ];

        $article = Article::create($data);
        //$article = $admin->articles()->create($data);
        $this->assertDatabaseHas('articles', $article->toArray());
    }

    public function test_that_articles_can_be_deleted(){

        $admin = factory('App\Admin')->create();
        $article = factory('App\Article')->create();
        $article->delete($article->id);
        $this->assertDatabaseMissing('articles', $article->toArray());
    }

    public function test_that_articles_can_have_a_author(){
        //$this->withoutExceptionHandling();

        $admin = factory('App\Admin')->create();
        $article = factory('App\Article')->create();
        $this->assertDatabaseHas('articles', ['author_id' => $admin->id]);
    }
}

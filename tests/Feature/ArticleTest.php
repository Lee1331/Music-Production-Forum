<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

use App\Article;

class ArticleTest extends TestCase
{
    use DatabaseMigrations;

    public function test_article_image_uploading(){
        $this->withoutExceptionHandling();

        //Given the admin has a account, and is logged in
        Storage::fake('public');
        $admin = factory('App\Admin')->create();
        $this->actingAs($admin);

        //then the admin can create a article, and upload custom images to the article
        $image = UploadedFile::fake()->image('header_image.png');

        //the article should store the image name in the database
        $article = factory('App\Article')->create(['author_id' => $admin->id, 'header_image' => $image->hashName()]);

        //and store the article in the database, and the uploaded image on the server
        $this->assertDatabaseHas('articles', [
            //'header_image' => 'header_image.png'
            'header_image' => $image->hashName()
        ]);
    }

    //artice.index
    public function test_if_a_guest_user_can_browse_the_articles(){
        // $this->withoutExceptionHandling();

        factory('App\Admin')->create();
        $article = factory('App\Article')->create();

        $responce = $this->get('/articles');
        $responce->assertSee($article->title, $article->body, $article->header_image, $article->body_image);
    }

    public function test_if_a_authenticated_user_can_browse_the_articles(){
        // $this->withoutExceptionHandling();
        $user = factory('App\Admin')->create();

        factory('App\Admin')->create();
        $article = factory('App\Article')->create();

        $responce = $this->actingAs($user)->get('/articles');
        $responce->assertSee($article->title, $article->body, $article->header_image, $article->body_image);
    }

    //article.show
    public function test_if_a_guest_user_can_view_one_article(){
        factory('App\User')->create();
        factory('App\Admin')->create();
        $article = factory('App\Article')->create();

        $responce = $this->get('/articles/'. $article->title);
        //$responce = $this->get('/forum/thread/show', $thread->title);
        $responce->assertSee($article->title, $article->body, $article->header_image, $article->body_image);
    }

    public function test_if_a_authenticated_user_can_view_one_article(){
        $user = factory('App\User')->create();
        factory('App\Admin')->create();
        $article = factory('App\Article')->create();

        $responce = $this->actingAs($user)->get('/articles/'. $article->title);
        $responce->assertSee($article->title, $article->body, $article->header_image, $article->body_image);
    }

    //Deleting
    public function test_that_a_admin_can_delete_articles(){
        $admin = factory('App\Admin')->create();
        $article = factory('App\Article')->create();

        $delete = $this->actingAs($admin)->json('DELETE', '/backend/admin/article/' . $article->id);
        $delete->assertStatus(302);
    }

    public function test_that_a_guest_user_cannot_delete_articles(){
        factory('App\Admin')->create();
        $article = factory('App\Article')->create();

        $delete = $this->json('DELETE', '/backend/admin/article/' . $article->id);
        $delete->assertRedirect('/admin/login');
    }

    public function test_that_a_authenticated_user_cannot_delete_articles(){
        $user = factory('App\User')->create();

        factory('App\Admin')->create();
        $article = factory('App\Article')->create();

        $delete = $this->actingAs($user)->json('DELETE', '/backend/admin/article/' . $article->id);
        $delete->assertRedirect('/admin/login');
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class TagTest extends TestCase{
    use DatabaseMigrations;

    public function test_that_an_admin_can_create_a_tag(){
        $this->withoutExceptionHandling();

        //Given the admin has a account, and is logged in
        $admin = factory('App\Admin')->create();
        $this->actingAs($admin, 'admin');

        //then the admin can create a tag
        $tag = factory('App\Tag')->make();
        $this->post('/backend/admin/tag', $tag->toArray());

        //and store it in the database - (we can't use $tag->toArray() because $tag doesnt contain an 'id' field because make() doesn't push data straight to the array, like create() does)
        $this->assertDatabaseHas('tags', ['name' => $tag->name]);
    }

    public function test_that_an_authenticated_user_cannot_create_a_tag(){
        $user = factory('App\User')->create();
        $this->actingAs($user);

        $this->get('/backend/admin/tag/create')->assertRedirect('/admin/login');
    }

    public function test_that_a_guest_user_cannot_create_a_tag(){
        $this->get('/backend/admin/tag/create')->assertRedirect('/admin/login');
    }

    public function test_that_a_guest_user_cannot_delete_tags(){
        factory('App\Admin')->create();
        $tag = factory('App\Tag')->create();

        $delete = $this->json('DELETE', '/backend/admin/tag/' . $tag->id);
        $delete->assertRedirect('/admin/login');
    }

    public function test_that_a_authenticated_user_cannot_delete_tags(){
        $user = factory('App\User')->create();

        factory('App\Admin')->create();
        $tag = factory('App\Tag')->create();

        $delete = $this->actingAs($user)->json('DELETE', '/backend/admin/tag/' . $tag->id);
        $delete->assertRedirect('/admin/login');
    }

    public function test_an_admin_can_assign_a_tag_to_a_article(){

        //Given that a tag already exists, the admin has a account, and is logged in
        $tag = factory('App\Tag')->create();
        $admin = factory('App\Admin')->create();
        $this->actingAs($admin);

        //then the admin can create a article, and assign it a tag
        $article = factory('App\Article')->create(['author_id' => $admin->id]);
        $article->tags()->sync($tag);

        //and store it in the database
        $this->assertDatabaseHas('articles', $article->toArray());
        $this->assertDatabaseHas('tags', $tag->toArray());
        $this->assertDatabaseHas('article_tag', ['article_id' => $article->id, 'tag_id' => $tag->id]);
    }

    public function test_an_admin_can_assign_multiple_tags_to_a_article(){
        //Given that at least 2 tags already exist, the admin has a account, and is logged in
        $tags = factory('App\Tag', rand(2,5))->create();
        $admin = factory('App\Admin')->create();
        $this->actingAs($admin);

        //then the admin can create a article, and assign it multiple tags
        $article = factory('App\Article')->create(['author_id' => $admin->id]);
        foreach($tags as $tag){
            $article->tags()->sync($tag);
            $this->assertDatabaseHas('tags', $tag->toArray());
            $this->assertDatabaseHas('article_tag', ['article_id' => $article->id, 'tag_id' => $tag->id]);
        }
        $this->assertDatabaseHas('articles', $article->toArray());
    }

    public function test_guest_can_browse_articles_by_tags(){
        //given that a tag exists, and is stored in the database
        factory('App\Admin')->create();
        $tag = factory('App\Tag')->create();
        $article = factory('App\Article')->create();
        factory('App\ArticleTag')->create();

        //then guests should see the article in that tag
        $responce = $this->get('/articles/tags/'. $tag->name);
        $responce->assertSee($article->title, $article->excerpt, $article->author->name);
    }

    public function test_authenticated_users_can_browse_articles_by_tags(){
        //given that a tag exists, and is stored in the database
        factory('App\Admin')->create();
        $tag = factory('App\Tag')->create();
        $article = factory('App\Article')->create();
        factory('App\ArticleTag')->create();
        //when the user logs in
        $user = factory('App\User')->create();
        $this->actingAs($user);
        //then thEY should be able to navigate to the tags section, and see the articles in that tag
        $responce = $this->get('/articles/tags/'. $tag->name);
        $responce->assertSee($article->title, $article->excerpt, $article->author->name);
    }
}

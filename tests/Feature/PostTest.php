<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostTest extends TestCase
{
    //use RefreshDatabase;
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_an_authenticated_user_can_create_a_post(){
        $this->withoutExceptionHandling();

        //Given the user has a account, and is logged in
        $user = factory('App\User')->create();
        $this->actingAs($user);

        //And Given that a thread already exists
        $category = factory('App\ForumCategory')->create();
        $thread = factory('App\ForumThread')->create();

        //then the user can create a post within that thread
        $post = factory('App\ForumPost')->create(['forum_thread_id' => $thread->id]);

        //and store it in the database
        $this->assertDatabaseHas('forum_posts', $post->toArray());
    }

    public function test_guest_users_cannot_create_a_post(){

        //Given that the user isn't logged in, and that a thread already exists
        factory('App\User')->create();
        factory('App\ForumCategory')->create();
        $thread = factory('App\ForumThread')->create();
        //then the user can't create a post within that thread
        $this->post('/forum/'.$thread->title.'/posts')->assertRedirect('/login');
    }

    public function test_that_posts_display_with_their_parent_thread(){
        $this->withoutExceptionHandling();

        //Given the user has a account, and is logged in
        factory('App\User')->create();

        //when a post is created in a thread
        $category = factory('App\ForumCategory')->create();
        $thread = factory('App\ForumThread')->create();

        //then the user should see the post displayed with the thread
        $post = factory('App\ForumPost')->create(['forum_thread_id' => $thread->id]);

        $responce = $this->get('/forum/' . $thread->title);
        $responce->assertSee($post->title, $post->body, $post->owner->name);
    }
}

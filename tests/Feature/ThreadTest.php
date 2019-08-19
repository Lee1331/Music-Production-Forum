<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\ForumThread;
class ThreadTest extends TestCase
{
    use DatabaseMigrations;
    //use RefreshDatabase;

    public function test_guest_users_cant_create_a_thread(){
        $this->get('/forum/thread/create')->assertRedirect('/login');
    }

    public function test_that_admins_can_delete_threads(){
        $this->withoutExceptionHandling();

        factory('App\User')->create();
        factory('App\ForumCategory')->create();
        $thread = factory('App\ForumThread')->create();

        $admin = factory('App\Admin')->create();
        $delete = $this->actingAs($admin, 'admin')->json('DELETE', '/backend/admin/thread/' . $thread->id);
        $delete->assertStatus(302);
        $this->assertDatabaseMissing('forum_threads', $thread->toArray());
    }

    public function test_if_a_authenticated_user_can_delete_their_thread(){
        $this->withoutExceptionHandling();

        //Given the user has a account, and is logged in
        $user = factory('App\User')->create();
        factory('App\ForumCategory')->create();
        $thread = factory(ForumThread::class)->create(['user_id' => $user->id]);

        $delete = $this->actingAs($user)->json('DELETE', '/forum/thread/' . $thread->id);
        $delete->assertStatus(302);

        $this->assertDatabaseMissing('forum_threads', $thread->toArray());
    }

    public function test_that_a_guest_user_cannot_delete_threads(){
        factory('App\User')->create();
        factory('App\ForumCategory')->create();
        $thread = factory(ForumThread::class)->create();

        $delete = $this->json('DELETE', '/forum/' . $thread->id);
        $delete->assertRedirect('/login');
    }

    public function test_if_a_guest_user_can_browse_the_threads(){

        factory('App\User')->create();
        factory('App\ForumCategory')->create();
        $thread = factory(ForumThread::class)->create();
        $responce = $this->get('/forum');
        $responce->assertSee($thread->title, $thread->body);
    }

    public function test_if_an_authenticated_user_can_browse_the_threads(){

        $user = factory('App\User')->create();

        factory('App\ForumCategory')->create();
        $thread = factory(ForumThread::class)->create();

        $responce = $this->actingAs($user)->get('/forum');
        $responce->assertSee($thread->title, $thread->body);
    }

    public function test_if_a_guest_user_can_view_one_thread(){
        factory('App\User')->create();
        factory('App\ForumCategory')->create();
        $thread = factory(ForumThread::class)->create();

        $responce = $this->get('/forum/'. $thread->title);
        $responce->assertSee($thread->title, $thread->body);
    }

    public function test_if_guests_can_view_one_thread(){
        factory('App\User')->create();
        factory('App\ForumCategory')->create();
        $thread = factory(ForumThread::class)->create();

        $responce = $this->get('/forum/'. $thread->title);
        $responce->assertSee($thread->title, $thread->body);
    }

    public function test_if_an_authenticated_user_can_view_one_thread(){
        $user = factory('App\User')->create();

        factory('App\ForumCategory')->create();
        $thread = factory(ForumThread::class)->create();

        $responce = $this->actingAs($user)->get('/forum/'. $thread->title);
        $responce->assertSee($thread->title, $thread->body);
    }
}

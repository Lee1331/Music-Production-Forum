<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Auth\AuthenticationException;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    public function test_that_guests_cannot_access_the_home_page(){
        $this->withoutExceptionHandling();
        $this->expectException(AuthenticationException::class);

        $responce = $this->get('/home');
        $responce->assertStatus(302);
        $responce->assertRedirect('/login');
    }

    public function test_that_authenticated_users_cannot_access_the_login_page(){
        //$this->withoutExceptionHandling();
        $user = factory('App\User')->create();

        $responce = $this->actingAs($user)->get('/login');
        //$responce->assertStatus(302);
        $responce->assertRedirect('/home');
    }

    public function test_that_users_can_edit_their_accounts(){
        //$this->withoutExceptionHandling();

        $user = factory('App\User')->create();
        $this->actingAs($user);

        $user->name = 'test';
        $user->email = 'testUserEdit@gmail.com';
        $user->save();
        //$this->json('PUT', route('home.update') , $user->toArray());
        $this->json('PUT', route('home.update', $user->toArray()));

        $this->assertEquals('test', $user->fresh()->name);
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    public function test_that_users_can_see_their_tracks_on_their_account(){
        //$this->withoutExceptionHandling();

        $user = factory('App\User')->create();
        $this->actingAs($user);

        $track = factory('App\Track')->create();
        factory('App\Feature')->states('track')->create();


        $responce = $this->get('/home/tracks');
        $responce->assertSee($track->name, $track->genre, $track->owner->name);
    }

    public function test_that_users_can_see_their_likes_on_their_account(){
        //$this->withoutExceptionHandling();

        $user = factory('App\User')->create();
        $this->actingAs($user);

        factory('App\ForumCategory')->create();
        factory('App\ForumThread')->create();
        $post = factory('App\ForumPost')->create();
        //$post->likeForumPost();
        $user->likePost($post);
        $responce = $this->get('/home/likes');
        //$responce->assertSee($post->title);
        $responce->assertSee($user->getLikedPosts());
    }


    public function test_that_a_users_tracks_can_be_viewed_on_their_account(){

        $user = factory('App\User')->create();
        $track = factory('App\Track')->create();
        factory('App\Feature')->states('track')->create();

        $responce = $this->get('/user/'. $user->name .'/tracks');
        $responce->assertSee($track->name, $track->genre, $track->owner->name);
        $this->assertEquals($track->owner->name, $user->name);
    }

    public function test_that_a_users_likes_can_be_viewed_on_their_account(){

        $user = factory('App\User')->create();

        factory('App\ForumCategory')->create();
        factory('App\ForumThread')->create();
        $post = factory('App\ForumPost')->create();
        //$user->likePost($post);
        $like = factory('App\LikeForumPost')->create();

        $responce = $this->get('/users/'. $user->name .'/likes');
        $responce->assertSee($like->forumPost->title);
        $this->assertEquals($like->forumPost->title, $post->title);

    }
}

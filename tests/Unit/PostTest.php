<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\ForumPost;
class PostTest extends TestCase
{
    use DatabaseMigrations;

    public function test_that_posts_can_be_created_by_users(){
        $this->withoutExceptionHandling();

        $user = factory('App\User')->create();

        factory('App\ForumCategory')->create();
        $thread = factory('App\ForumThread')->create();

        $data = [
            'title' => 'test_that_posts_can_be_created',
            'body' => 'this should create a new post',
            'user_id' => $user->id,
            'forum_thread_id' => $thread->id,
        ];

        //$user->forumPosts()->create($data);
        ForumPost::create($data);

        $this->assertDatabaseHas('forum_posts', $data);
    }

    public function test_that_posts_can_be_deleted_by_users(){
        $user = factory('App\User')->create();

        factory('App\ForumCategory')->create();
        factory('App\ForumThread')->create();
        $post = factory('App\ForumPost')->create();

        $user->forumPosts()->delete($post->id);
        $this->assertDatabaseMissing('forum_posts', $post->toArray());
    }

    //testing the relationship
    public function test_that_posts_can_be_liked_and_disliked(){
        $user = factory('App\User')->create();

        factory('App\ForumCategory')->create();
        factory('App\ForumThread')->create();
        $post = factory('App\ForumPost')->create();

        $data = [
            'user_id' => $user->id,
            'forum_post_id' => $post->id
        ];

        //test the relationships
        $post->likes()->create($data);
        $this->assertDatabaseHas('like_forum_posts', $data);

        $post->likes()->delete($data);
        $this->assertDatabaseMissing('like_forum_posts', $data);
    }

    //testing the methods
    public function test_that_posts_can_be_liked_and_disliked_via_methods(){
        $user = factory('App\User')->create();
        $this->actingAs($user);

        factory('App\ForumCategory')->create();
        factory('App\ForumThread')->create();
        $post = factory('App\ForumPost')->create();

        $data = [
            'user_id' => $user->id,
            'forum_post_id' => $post->id
        ];

        $post->likeForumPost();
        $this->assertDatabaseHas('like_forum_posts', $data);

        $post->dislikeForumPost();
        $this->assertDatabaseMissing('like_forum_posts', $data);
    }

    public function test_that_posts_can_have_a_thread(){
        $user = factory('App\User')->create();
        factory('App\ForumCategory')->create();
        $thread = factory('App\ForumThread')->create();
        //$post = factory('App\ForumPost')->create();
        $post = factory('App\ForumPost')->make();

        ForumPost::create($post->toArray());
        //$user->forumPosts()->create($post->toArray());

        $this->assertDatabaseHas('forum_posts', ['forum_thread_id' => $thread->id, 'user_id' => $user->id]);
        //$this->assertTrue($post->owner($user->id));
    }

}

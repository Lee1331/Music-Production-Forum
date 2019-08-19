<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\ForumThread;
class ThreadTest extends TestCase
{

    // use RefreshDatabase;
    use DatabaseMigrations;

    public function test_that_threads_can_be_created_by_users(){
        $user = factory('App\User')->create();
        $category = factory('App\ForumCategory')->create();

        $data = [
            'title' => 'test_if_a_authenticated_user_can_have_a_thread',
            'body' => 'this should create a new thread',
            'category_id' => $category->id,
            'user_id' => $user->id,
        ];

        $user->forumThreads()->create($data);
        //$thread = ForumThread::create($data);
        //$this->assertDatabaseHas('forum_threads', $thread->toArray());
        $this->assertDatabaseHas('forum_threads', $data);
    }

    public function test_that_threads_can_be_deleted_by_users(){
        $user = factory('App\User')->create();
        factory('App\ForumCategory')->create();
        $thread = factory('App\ForumThread')->create();

        $user->forumThreads()->delete($thread->id);
        $this->assertDatabaseMissing('forum_threads', $thread->toArray());
    }

    public function test_that_threads_can_have_a_post(){
        $user = factory('App\User')->create();
        factory('App\ForumCategory')->create();
        $thread = factory('App\ForumThread')->create();

        $data = [
            'title' => 'test_that_threads_can_have_a_post',
            'body' => 'this should create a new post',
            'forum_thread_id' => $thread->id
        ];

        $user->ForumPosts()->create($data);
        $this->assertDatabaseHas('forum_posts', $data);
        $this->assertDatabaseHas('forum_posts', ['forum_thread_id' => $thread->id]);
    }

    public function test_that_threads_can_have_multiple_posts(){
        $user = factory('App\User')->create();
        factory('App\ForumCategory')->create();
        $thread = factory('App\ForumThread')->create();
        $posts = factory('App\ForumPost', rand(2,5))->create();

        foreach($posts as $post){
            $this->assertDatabaseHas('forum_posts', ['forum_thread_id' => $thread->id]);
        }
    }

    public function test_that_threads_can_have_a_category(){
                $this->withoutExceptionHandling();

        $user = factory('App\User')->create();
        $category = factory('App\ForumCategory')->create();
        $thread = factory('App\ForumThread')->make();

        $category->threads()->create($thread->toArray());

        $this->assertDatabaseHas('forum_threads', ['category_id' => $category->id]);
    }

}

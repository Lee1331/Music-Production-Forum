<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminTest extends TestCase{
    use DatabaseMigrations;

    public function test_that_admins_can_delete_users(){
        // $this->withoutExceptionHandling();

        $user = factory('App\User')->create();

        $admin = factory('App\Admin')->create();
        $delete = $this->actingAs($admin, 'admin')->json('DELETE', '/backend/admin/user/' . $user->id);
        $delete->assertStatus(302);
        $this->assertDatabaseMissing('users', $user->toArray());
    }

    public function test_that_admins_can_delete_threads(){

        $user = factory('App\User')->create();
        factory('App\ForumCategory')->create();
        $thread = factory('App\ForumThread')->create();

        $admin = factory('App\Admin')->create();
        $delete = $this->actingAs($admin, 'admin')->json('DELETE', '/backend/admin/thread/' . $thread->id);
        $delete->assertStatus(302);
        $this->assertDatabaseMissing('forum_threads', $thread->toArray());
    }

    public function test_that_admins_can_delete_posts(){
        $user = factory('App\User')->create();
        factory('App\ForumCategory')->create();
        factory('App\ForumThread')->create();
        $post = factory('App\ForumPost')->create();

        $admin = factory('App\Admin')->create();
        $delete = $this->actingAs($admin, 'admin')->json('DELETE', '/backend/admin/post/' . $post->id);
        $delete->assertStatus(302);
        $this->assertDatabaseMissing('forum_posts', $post->toArray());
    }

    public function test_that_admins_can_delete_categories(){
        $user = factory('App\User')->create();
        $category = factory('App\ForumCategory')->create();
        $thread = factory('App\ForumThread')->create();

        $admin = factory('App\Admin')->create();
        $delete = $this->actingAs($admin, 'admin')->json('DELETE', '/backend/admin/category/' . $category->id);
        $delete->assertStatus(302);
        $this->assertDatabaseMissing('forum_categories', $category->toArray());
        $this->assertDatabaseMissing('forum_threads', $thread->toArray());
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    public function test_an_admin_can_create_a_category(){
        //Given the admin has a account, and is logged in
        $admin = factory('App\Admin')->create();
        $this->actingAs($admin);

        //then the admin can create a category
        $category = factory('App\ForumCategory')->create();
        $this->post('/backend/admin/category/create', $category->toArray());

        //and store it in the database
        $this->assertDatabaseHas('forum_categories', $category->toArray());
    }

    public function test_an_authenticated_user_cannot_create_a_category(){
        //Given the user has a account, and is logged in
        $user = factory('App\User')->create();
        $this->actingAs($user);
        $this->get('/backend/admin/category/create')->assertRedirect('/admin/login');
    }

    public function test_a_guest_cannot_create_a_category(){
        $this->get('/backend/admin/category/create')->assertRedirect('/admin/login');
    }

    public function test_that_a_authenticated_user_can_assign_a_thread_to_a_category(){

        //given that a category exists, and is stored in the database
        factory('App\Admin')->create();
        $category = factory('App\ForumCategory')->create();
        $this->post('/backend/admin/category/create', $category->toArray());

        //then authenticated users can access the thread.create page
        $user = factory('App\User')->create();
        $this->actingAs($user);
        $this->get('/forum/thread/create');
        //and create a thread using category_id
        $thread = factory('App\ForumThread')->create(['category_id' => $category->id]);
        $this->post('/forum/thread/store', $thread->toArray());

        //which will be stored in the database
        $this->assertDatabaseHas('forum_threads', $thread->toArray());
    }

    public function test_that_a_guest_cannot_assign_a_thread_to_a_category(){
        //given that a category exists, and is stored in the database
        factory('App\Admin')->create();
        $category = factory('App\ForumCategory')->create();

        //then guest users cannot assign the category to a thread, because they are redirected to the login page
        $this->get('/forum/thread/create')->assertRedirect('/login');

    }

    public function test_guests_can_browse_threads_by_category(){
        //given that a category exists, and is stored in the database
        factory('App\Admin')->create();
        $category = factory('App\ForumCategory')->create();

        //and that a thread exists in the category
        factory('App\User')->create();
        $thread = factory('App\ForumThread')->create(['category_id' => $category->id]);
        $this->post('/forum/thread/store', $thread->toArray());

        //then the thread should appear in that category
        $responce = $this->get('/forum/category/'. $category->name);
        $responce->assertSee($thread->title, $thread->body, $thread->created_at, $thread->view_count, $thread->category->name, $thread->owner->name);
    }

    public function test_authenticated_users_can_browse_threads_by_category(){
        //given that a category exists, and is stored in the database
        factory('App\Admin')->create();
        $category = factory('App\ForumCategory')->create();

        //and that a thread exists in the category
        factory('App\User')->create();
        $thread = factory('App\ForumThread')->create(['category_id' => $category->id]);
        $this->post('/forum/thread/store', $thread->toArray());

        //then the logged in user should see the thread in that category
        $user = factory('App\User')->create();
        $this->actingAs($user);

        $responce = $this->get('/forum/category/'. $category->name);
        $responce->assertSee($thread->title, $thread->body, $thread->created_at, $thread->view_count, $thread->category->name, $thread->owner->name);
    }
}

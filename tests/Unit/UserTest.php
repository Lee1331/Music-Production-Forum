<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
class UserTest extends TestCase
{
    use DatabaseMigrations;

    public function test_that_users_can_be_created(){
        $data = [
            'name' => 'John',
            'bio' => 'this should create a new user',
            'email' => 'John@test.com',
        ];

        $user = User::create($data);
        $this->assertDatabaseHas('users', $user->toArray());
    }

    public function test_that_users_can_be_deleted(){
        $user = factory('App\User')->create();
        $user->delete($user->id);
        $this->assertDatabaseMissing('users', $user->toArray());
    }

    public function test_that_profile_images_can_be_deleted(){
        $user = factory('App\User')->create();

        $user->destroyProfileImage();
        //$this->assertEquals($user->profile_image, null);
        $this->assertDatabaseMissing('users', ['profile_image' => '']);
    }
}

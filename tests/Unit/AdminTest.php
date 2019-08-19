<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Admin;

class AdminTest extends TestCase
{
    use DatabaseMigrations;

    public function test_that_admins_can_be_created(){
        $data = [
            'name' => 'John',
            'bio' => 'this should create a new admin',
            'email' => 'John@test.com',
        ];

        $admin = Admin::create($data);
        $this->assertDatabaseHas('admins', $admin->toArray());
    }

    public function test_that_admins_can_be_deleted(){
        $admin = factory('App\Admin')->create();
        $admin->delete($admin->id);
        $this->assertDatabaseMissing('admins', $admin->toArray());
    }
}

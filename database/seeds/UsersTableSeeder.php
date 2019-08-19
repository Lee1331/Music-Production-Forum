<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        //delete the users table when the seeder is called
        DB::table('users')->delete();

        Eloquent::unguard();

		//disable foreign key before we run the seeder
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        factory(App\User::class, 50)->create();

        //Also create these accounts - used for easy testing purposes
        DB::table('users')->insert([
            [
                'name' => 'Test',
                'email' => 'test@gmail.com',
                'password' => bcrypt('secret'),
                'email_verified_at' => now(),
                'bio' => 'Sed ut perspiciatis unde omnis iste natus',
            ],
            [
                'name' => 'Test2',
                'email' => 'test2@gmail.com',
                'password' => bcrypt('secret'),
                'email_verified_at' => now(),
                'bio' => 'Sed ut perspiciatis unde omnis iste natus',

            ],
        ]);
    }
}

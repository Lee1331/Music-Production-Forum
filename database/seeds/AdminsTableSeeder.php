<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('admins')->truncate();

        DB::table('admins')->insert([
            'name' => 'Lee',
            'email' => 'lee1331@hotmail.co.uk',
            'password' => bcrypt('secret'),
        ]);

        factory(App\Admin::class, 4)->create();

    }
}

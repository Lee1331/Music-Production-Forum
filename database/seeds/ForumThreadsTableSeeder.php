<?php

use Illuminate\Database\Seeder;

class ForumThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

		//disable foreign key before we run the seeder
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        factory(App\ForumThread::class, 10)->create();

    }
}

<?php

use Illuminate\Database\Seeder;

class ForumPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reset the users table when the seeder is called
        DB::table('forum_posts')->truncate();
        factory(App\ForumPost::class, 50)->create();
    }
}

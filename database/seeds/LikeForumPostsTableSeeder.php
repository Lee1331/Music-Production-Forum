<?php

use Illuminate\Database\Seeder;

class LikeForumPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //reset the table when the seeder is called
    DB::table('like_forum_posts')->truncate();
    factory(App\LikeForumPost::class, 5)->create();

    }
}

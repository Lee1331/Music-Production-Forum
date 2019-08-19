<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * Note the the order of execution does matter
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(TrackTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(ArticleTableSeeder::class);
        $this->call(ArticleTagTableSeeder::class);
        $this->call(FeatureTableSeeder::class);
        $this->call(ForumCategoriesTableSeeder::class);
        $this->call(ForumThreadsTableSeeder::class);
        $this->call(ForumPostsTableSeeder::class);
        $this->call(LikeForumPostsTableSeeder::class);
    }
}

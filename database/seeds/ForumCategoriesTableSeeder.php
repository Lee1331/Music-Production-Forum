<?php

use Illuminate\Database\Seeder;

class ForumCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reset the users table when the seeder is called
        DB::table('forum_categories')->truncate();
        factory(App\ForumCategory::class, 5)->create();

    }
}


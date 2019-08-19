<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->truncate();
        factory(App\Tag::class, 30)->create();
        DB::table('tags')->insert([
            'name' => 'Featured',
            'created_at' => now(),
        ]);
    }
}

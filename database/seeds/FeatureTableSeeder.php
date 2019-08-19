<?php

use Illuminate\Database\Seeder;

class FeatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('features')->delete();
        factory(App\Feature::class, 5)->states('article')->create();
        factory(App\Feature::class, 5)->states('track')->create();
    }
}

<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FeatureTest extends TestCase
{
    use DatabaseMigrations;

    public function test_that_featured_articles_can_be_created()
    {
        factory('App\Admin')->create();
        $article = factory('App\Article')->create();
        $feature = factory('App\Feature')->states('article')->create();

        $this->assertDatabaseHas('features', $feature->toArray());
        $this->assertInstanceOf('App\Feature', $article->featured);
    }

    public function test_that_featured_tracks_can_be_created()
    {
        factory('App\Admin')->create();
        factory('App\User')->create();
        $track = factory('App\Track')->create();
        $feature = factory('App\Feature')->states('track')->create();

        $this->assertDatabaseHas('features', $feature->toArray());
        $this->assertInstanceOf('App\Feature', $track->featured);

    }

    public function test_that_unfeaturing_a_article_destroys_the_relationship()
    {
        factory('App\Admin')->create();
        $article = factory('App\Article')->create();
        $feature = factory('App\Feature')->states('article')->create();

        $feature->delete();

        $this->assertDatabaseMissing('features', $feature->toArray());
        $this->assertDatabaseHas('articles', $article->toArray());

    }

    public function test_that_unfeaturing_a_track_destroys_the_relationship()
    {
        factory('App\Admin')->create();

        factory('App\User')->create();
        $track = factory('App\Track')->create();
        $feature = factory('App\Feature')->states('track')->create();

        $feature->delete();

        $this->assertDatabaseMissing('features', $feature->toArray());
        $this->assertDatabaseHas('tracks', $track->toArray());

    }

}

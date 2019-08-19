<?php

namespace Tests\Feature;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

// use Illuminate\Notifications\Notification;
use Notification;
use \Illuminate\Notifications\DatabaseNotification;
use App\Notifications\FeaturedTrack;
use App\Notifications\LikedForumPost;
use App\Notifications\RepliedToForumThread;

// use Illuminate\Notifications\AnonymousNotifiable;

class NotificationTest extends TestCase
{

    use DatabaseMigrations;

    public function test_FeaturedTrack()
    {
        Notification::fake();

        $user = factory('App\User')->create();
        $track = factory('App\Track')->create();
        $feature = factory('App\Feature')->states('track')->create();

        $track->owner->notify(new FeaturedTrack($track));

        Notification::assertSentTo($user, FeaturedTrack::class);
    }

    public function test_LikedForumPost()
    {
        $this->withoutExceptionHandling();

        Notification::fake();

        $threadOwner = factory('App\User')->create();
        $user = factory('App\User')->create();

        factory('App\ForumCategory')->create();
        $thread = factory('App\ForumThread')->create();
        $post = factory('App\ForumPost')->create();

        //delete previous like - running the test more than once without this will cause an error each post can only be liked by the same user once
        $this->actingAs($user)->delete('/forum/'.$post->title.'/like', $post->toArray());

        // $this->post(route('like.post'), $post->toArray());
        $this->actingAs($user)->post('/forum/'.$post->title.'/like', $post->toArray());

        $post->owner->notify(new LikedForumPost($post));
        Notification::assertSentTo($user, LikedForumPost::class);
        //$this->assertDatabaseHas('notifications', ['type' => 'App\\LikedForumPost' ]);
    }

    public function test_RepliedToForumThread()
    {
        Notification::fake();
        $user = factory('App\User')->create();

        factory('App\ForumCategory')->create();
        $thread = factory('App\ForumThread')->create();
        $post = factory('App\ForumPost')->create();

        $thread->owner->notify(new RepliedToForumThread($post));

        Notification::assertSentTo($user, RepliedToForumThread::class);
    }

    public function test_authenticated_users_can_see_their_notifications(){
        $user = factory('App\User')->create();

        $track = factory('App\Track')->create();
        $notification = $track->owner->notify(new FeaturedTrack($track));

        $responce = $this->actingAs($user)->get('/user/notifications');
        $responce->AssertSee($notification);
    }
}

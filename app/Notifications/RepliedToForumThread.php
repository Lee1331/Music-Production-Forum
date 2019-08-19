<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class RepliedToForumThread extends Notification
{
    use Queueable;

    public $thread;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($thread){
        //
        $this->thread = $thread;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the broadcast representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'thread' => $this->thread,
            'user' => auth()->user(),
        ]);
    }

    /**
     * Get the database representation of the notification.
     *
     * @param  mixed  $notifiable
     *
     */
    public function toDatabase($notifiable)
    {
        return[
            'thread' => $this->thread,
            'user' => auth()->user(),
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

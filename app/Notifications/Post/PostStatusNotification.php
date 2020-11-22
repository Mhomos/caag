<?php

namespace App\Notifications\Post;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Psy\Util\Str;

class PostStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var string
     */
    private $url;

    /**
     * @var \App\Models\Post
     */
    private $post;

    /**
     * @var string
     */
    private $status;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\Post $post
     * @param string $status
     */
    public function __construct(Post $post, $status = 'created')
    {
        $this->url = route('posts.show', $post->id);
        $this->post = $post;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->greeting('Hello!')
            ->subject('Post '.$this->status.'!')
            ->line('a post has been '.$this->status.'!')
            ->line($this->post->title)
            ->line(\Illuminate\Support\Str::limit($this->post->details, 100))
            ->action('View Post', $this->url)
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [//
        ];
    }
}

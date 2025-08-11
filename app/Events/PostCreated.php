<?php

namespace App\Events;

use App\Models\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PostCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Post $post)
    {
        Log::info('PostCreated event created', ['post_id' => $this->post->id]);
        $this->post->load('user:id,first_name,last_name');
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('admin-notifications'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'post.created'; // lowercase
    }


    public function broadcastWith(): array
    {
        return [
            'id' => $this->post->id,
            'title' => $this->post->title,
            'description' => $this->post->description,
            'user' => [
                'id' => $this->post->user->id,
                'name' => $this->post->user->first_name . ' ' . $this->post->user->last_name,
            ],
            'created_at' => $this->post->created_at->diffForHumans(),
        ];
    }
}

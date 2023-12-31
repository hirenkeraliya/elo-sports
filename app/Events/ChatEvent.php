<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message,$user,$chat,$createAt;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message,$user,$chat,$createAt)
    {
      
        $this->message = $message;
        $this->createAt = $createAt;
        $this->user = $user;
        $this->chat = $chat;
       
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
   
    public function broadcastOn()
    {
   
        return new Channel('chat-room');
    }
    public function broadcastAs()
    {
        return 'new-message';
    }
  
    
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewCommentNotification extends Notification
{
    use Queueable;

    protected $commentContent;
    protected $postId;
    protected $userName;

    public function __construct($commentContent, $postId, $userName)
    {
        $this->commentContent = $commentContent;
        $this->postId = $postId;
        $this->userName = $userName;
    }

    // Define the channels the notification should be sent to (e.g., database)
    public function via($notifiable)
    {
        return ['database'];
    }

    // Data to be stored in the notifications table
    public function toDatabase($notifiable)
    {
        return [
            'comment_text' => $this->commentContent,
            'post_id' => $this->postId,
            'user_name' => $this->userName,
        ];
    }

    public function toArray($notifiable)
    {
        return [
            // Optionally return the same data here for array-based notifications
        ];
    }
}

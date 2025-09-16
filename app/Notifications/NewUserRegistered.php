<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class NewUserRegistered extends Notification
{
    use Queueable;

    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Notification channels (database + mail).
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Mail message for admin.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New User Registered')
            ->greeting('Hello Admin,')
            ->line('A new user has registered on the system.')
            ->line('Name: ' . $this->user->name)
            ->line('Email: ' . $this->user->email)
            ->action('View User', url('/admin/users'))
            ->line('Thank you!');
    }

    /**
     * Database notification format.
     */
   public function toDatabase($notifiable)
{
    return [
        'user_id' => $this->user->id,
        'name'    => $this->user->name,
        'email'   => $this->user->email,
        'message' => "New user {$this->user->name} has registered."
    ];
}

}

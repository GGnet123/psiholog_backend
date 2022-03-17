<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;


class NewClaimNotifications extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['telegram'];
    }

    public function toTelegram($notifiable)
    {
        $content = "Новая жалоба!\n";
        $content .= "ID жалобы: *".$notifiable->id."*\n";
        $content .= "От пользователя: *".($notifiable->relFromUser ? $notifiable->relFromUser->name : '')." (".$notifiable->from_user_id.")*\n";
        $content .= "На пользователя: *".($notifiable->relUser ? $notifiable->relUser->name : '')." (".$notifiable->user_id.")*\n";
        $content .= "Текст жалобы: *".$notifiable->note."*";

        $message = TelegramMessage::create();
        $message = $message->to(config('services.telegram-bot-api.chat_id'));

        $message = $message->content($content);

        return $message;
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;


class NewSupportMessageNotifications extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['telegram'];
    }

    public function toTelegram($notifiable)
    {
        $content = "Новая сообшение службы поддержки!\n";
        $content .= "ID сообшение: *".$notifiable->id."*\n";
        $content .= "Заголовок сообшение: *".$notifiable->name."*\n";
        $content .= "Текст сообшение: *".$notifiable->note."*\n";
        $content .= "От пользователя: *".($notifiable->relFromUser ? $notifiable->relFromUser->name : '')." (".$notifiable->from_user_id.")*\n";

        $message = TelegramMessage::create();
        $message = $message->to(config('services.telegram-bot-api.chat_id'));

        $message = $message->content($content);

        return $message;
    }
}

<?php

namespace App\Notifications\Fcm;

use App\Models\User;
use Carbon\Carbon;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;

trait NotifyFcmTrait {
    public string $title;
    public string $body;
    public string $title_en;
    public string $body_en;
    public string $title_ru;
    public string $body_ru;
    public string $group_type;
    public string $event_type;
    public int $el_id;

    private function setData(string $title_en, string $title_ru, string $body_en, string $body_ru, string $group_type, string $event_type, int $el_id = 0){
        $this->title_en = $title_en;
        $this->title_ru = $title_ru;
        $this->body_en = $body_en;
        $this->body_ru = $body_ru;
        $this->group_type = $group_type;
        $this->event_type = $event_type;
        $this->el_id = $el_id;
    }


    public function via($notifiable) {

        return ['database', FcmChannel::class];
    }

    private function calcTransTitleAndBody($user){
        if ($user->lang == User::EN_LANG){
            $this->title = $this->title_en;
            $this->body = $this->body_en;
        }
        else {
            $this->title = $this->title_ru;
            $this->body = $this->body_ru;

        }
    }

    public function toFcm($notifiable) {
        $this->calcTransTitleAndBody($notifiable);

        $data = [
            'created' => Carbon::now()->format('d.m.Y H:i:s'),
            'group_type' => $this->group_type,
            'event_type' => $this->event_type,
            'notification' =>  (string) json_encode([
                'title_ru' => $this->title_ru,
                'body_ru' => $this->body_ru,
                'title_en' => $this->title_en,
                'body_en' => $this->body_en
            ])
        ];



        if ($this->el_id > 0)
            $data['el_id'] = (string)$this->el_id;

        return FcmMessage::create()
            ->setData($data)
            ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
                ->setTitle($this->title)
                ->setBody($this->body)
            );
    }

    public function toDatabase($notifiable) {
        $this->calcTransTitleAndBody($notifiable);

        $data = [
            'title_ru' => $this->title_ru,
            'body_ru' => $this->body_ru,
            'title_en' => $this->title_en,
            'body_en' => $this->body_en,
            'created' => Carbon::now()->format('d.m.Y H:i:s'),
            'group_type' => $this->group_type,
            'event_type' => $this->event_type,
            'token' => $notifiable->fcm_token,
        ];

        if ($this->el_id > 0)
            $data['el_id'] = $this->el_id;

        return $data;
    }
}

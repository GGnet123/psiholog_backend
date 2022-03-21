<?php
namespace App\Services\Cron;


use App\Models\Content\MainGalary;
use App\Models\User;
use App\Notifications\Fcm\NeedDoMeditationNotification;
use App\Notifications\Fcm\ShowAffirmationNotification;

class NeedDoMeditationService {
    static function do(){
        $now = static::calcNow();
        if (!in_array($now->format('N'), [2, 4, 6]))
            return;

        $items = User::inRandomOrder()->take(50)->get();
        $med = MainGalary::where('type', MainGalary::TYPE_MEDITATION)->inRandomOrder()->first();
        foreach ($items as $user){
            if ($user && $user->fcm_token && $user->notify_all){
                $user->notify(new NeedDoMeditationNotification($med));
            }
        }
    }


    static function  calcNow(){
        date_default_timezone_set('Asia/Dhaka');

        $datetime = new \DateTime();
        $timezone = new \DateTimeZone('Asia/Dhaka');
        $datetime->setTimezone($timezone);

        return $datetime;
    }
}

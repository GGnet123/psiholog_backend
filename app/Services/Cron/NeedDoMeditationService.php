<?php
namespace App\Services\Cron;


use App\Models\Content\MainGalary;
use App\Models\User;
use App\Notifications\Fcm\NeedDoMeditationNotification;
use App\Notifications\Fcm\ShowAffirmationNotification;

class NeedDoMeditationService {
    static function do(){
        $items = User::inRandomOrder()->take(50)->get();
        $med = MainGalary::where('type', MainGalary::TYPE_MEDITATION)->inRandomOrder()->first();
        foreach ($items as $user){
            if ($user && $user->fcm_token && $user->notify_all){
                $user->notify(new NeedDoMeditationNotification($med));
            }
        }
    }
}

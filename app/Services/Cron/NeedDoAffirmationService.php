<?php
namespace App\Services\Cron;


use App\Models\Content\MainGalary;
use App\Models\User;
use App\Notifications\Fcm\ShowAffirmationNotification;

class NeedDoAffirmationService {
    static function do(){
        $items = User::inRandomOrder()->take(50)->get();
        $affirmation = MainGalary::where('type', MainGalary::TYPE_AFFIRMATION)->inRandomOrder()->first();

        foreach ($items as $user){
            if ($user && $user->fcm_token && $user->notify_all){
                $user->notify(new ShowAffirmationNotification($affirmation));
            }
        }
    }
}

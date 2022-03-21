<?php
namespace App\Services\Cron;

use App\Events\WillPaedSubscriptionEvent;
use App\Models\Main\Subscription;

class CalcWillPayedSubscriptionService {
    static function calc(){
        $now = static::calcNow();

        $items = Subscription::where('date_e', $now->format('Y-m-d'))
            ->where(['is_active' => true, 'is_cancel_by_user' => false, 'is_cancel_by_system' => false])->get();

        foreach ($items as $i){
            event(new WillPaedSubscriptionEvent($i));
        }
    }

    static function  calcNow(){
        date_default_timezone_set('Asia/Dhaka');

        $datetime = new \DateTime();
        $timezone = new \DateTimeZone('Asia/Dhaka');
        $datetime->setTimezone($timezone);
        $datetime->modify('+2 Day');

        return $datetime;
    }
}

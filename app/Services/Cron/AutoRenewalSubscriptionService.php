<?php
namespace App\Services\Cron;

use App\Models\Main\Subscription;
use App\Models\Record\RecordDoctor;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AutoRenewalSubscriptionService {
    private Collection $subscriptions;
    private DateTime $now;
    static function do(){
        $el = new AutoRenewalSubscriptionService();
        $el->start();
    }

    function start(){
        $this->calcNow();
        $this->calcSubscriptions();

        if ($this->subscriptions->count() > 0)
            $this->renewalSubscriptions();
    }

    private function renewalSubscriptions(){
        foreach ($this->subscriptions as $s){
            DB::beginTransaction();
            try {
                RenewalSingleSubscriptionService::do($s);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();

                Log::error($e);
            }
        }
    }

    private function calcSubscriptions(){
        $this->subscriptions = Subscription::where('is_active', RecordDoctor::CREATED_STATUS)
            ->where('date_e',  $this->now->format('Y-m-d'))
            ->where('is_cancel_by_user', false)
            ->where('is_cancel_by_system', false)
            ->get();
    }

    private function  calcNow(){
        date_default_timezone_set('Asia/Dhaka');

        $datetime = new DateTime();
        $timezone = new DateTimeZone('Asia/Dhaka');
        $datetime->setTimezone($timezone);
        $datetime->modify('+1 Day');

        $this->now = $datetime;
    }
}

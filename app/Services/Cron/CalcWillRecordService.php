<?php
namespace App\Services\Cron;

use App\Events\WillRecordEvent;
use App\Models\Record\RecordDoctor;

class CalcWillRecordService {
    static function calc(){
        $now = static::calcNow();

        $items = RecordDoctor::where('status_id', RecordDoctor::APPROVED_STATUS)->where('record_date', $now->format('Y-m-d'))->get();

        foreach ($items as $i){
            event(new WillRecordEvent($i));
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

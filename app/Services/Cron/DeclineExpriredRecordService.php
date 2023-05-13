<?php
namespace App\Services\Cron;

use App\Events\CancelRecordBySystemEvent;
use App\Models\Record\RecordDoctor;
use App\Services\DeclineRecordTransactionSerivce;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeclineExpriredRecordService {
    private Collection $recors;
    private DateTime $now;
    static function do(){
        $el = new DeclineExpriredRecordService();
        $el->start();
    }

    function start(){
        $this->calcNow();
        $this->calcRecords();

        if ($this->recors->count() > 0)
            $this->declineRecords();
    }

    private function declineRecords(){


        foreach ($this->recors as $r){
            DB::beginTransaction();
            try {
                $r->update(['status_id' => RecordDoctor::DECLINE_BY_SYSTEM]);

                DeclineRecordTransactionSerivce::do($r);

                event(new CancelRecordBySystemEvent($r));
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();

                Log::error($e);
            }
        }
    }

    private function calcRecords(){
        $this->recors = RecordDoctor::where('status_id', RecordDoctor::CREATED_STATUS)
                                    ->where(function($q){
                                        $q->where('record_date', '<', $this->now->format('Y-m-d'))
                                            ->orWhere(function($b){
                                                $b->where('record_date',$this->now->format('Y-m-d'))
                                                    ->orWhere('record_time', '<', $this->now->format('H:i:').':00');

                                            });
                                    })
                                    ->where('is_canceled', false)
                                    ->get();
    }

    private function  calcNow(){
        date_default_timezone_set('Asia/Dhaka');

        $datetime = new DateTime();
        $timezone = new DateTimeZone('Asia/Dhaka');
        $datetime->setTimezone($timezone);

        $datetime->modify('-12 hours');

        $this->now = $datetime;
    }
}

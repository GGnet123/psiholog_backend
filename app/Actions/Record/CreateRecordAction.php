<?php
namespace App\Actions\Record;

use App\Actions\AbstractAction;
use App\Events\CreateRecordEvent;
use App\Exceptions\Record\RecordDateAndTimeExpiredException;
use App\Exceptions\Record\RecordHourBusyException;
use App\Exceptions\Record\UserNotDoctorException;
use App\Models\Main\Coupon;
use App\Models\Record\RecordDoctor;
use App\Services\CreateRecordTransactionService;
use App\Services\DoctorFreeHourService;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;

class CreateRecordAction extends AbstractAction {
    private $hour_str;

    protected function do(){
        $doctor = $this->model;
        if (!$doctor->isDoctor())
            throw new UserNotDoctorException();

        $this->hour_str = str_pad($this->data['record_time'], 2, '0', STR_PAD_LEFT).':00';

        $this->checkDateTimeExpired();
        $this->checkHour();

        $item = new RecordDoctor();
        $item->customer_id = Auth::user()->id;
        $item->doctor_id = $doctor->id;
        $item->sum = $doctor->price;
        $item->record_date = $this->data['record_date'];
        $item->record_time = $this->hour_str;
        $item->status_id = RecordDoctor::CREATED_STATUS;
        $item->is_canceled =  false;
        $item->is_moved = true;

        $coupon = null;
        if (isset($this->data['code']) && $this->data['code']) {
            $code = $this->data['code'];
            $coupon = Coupon::where(['code' => $code, 'is_used' => false])->first();
            if ($coupon->sum < $doctor->price) {
                throw new \Exception('Coupon sum is not enough');
            }
            $coupon->is_used = true;
            $coupon->save();

            $item->coupon_id = $coupon->id;
        }

        $item->save();

        event(new CreateRecordEvent($item, Auth::user()));

        if (!$coupon) {
            CreateRecordTransactionService::do(Auth::user(), $item);
        }

        return $item;
    }

    private function checkDateTimeExpired(){
        date_default_timezone_set('Asia/Dhaka');

        $now = new DateTime();
        $timezone = new DateTimeZone('Asia/Dhaka');
        $now->setTimezone($timezone);
        $now->modify('+12 hours');

        $record_date = new DateTime($this->data['record_date'].' '.$this->hour_str);

        if ($record_date < $now)
            throw new RecordDateAndTimeExpiredException();
    }

    function checkHour(){
        $date = new DateTime($this->data['record_date']);
        $ar_hour = DoctorFreeHourService::getHour($this->model, $date);

        if ($ar_hour[$this->hour_str] != 'FREE')
            throw new RecordHourBusyException();
    }
}

<?php
namespace App\Actions\Record;

use App\Actions\AbstractAction;
use App\Events\CreateRecordEvent;
use App\Exceptions\Record\RecordHourBusyException;
use App\Exceptions\Record\UserNotDoctorException;
use App\Models\Record\RecordDoctor;
use App\Services\DoctorFreeHourService;
use DateTime;
use Illuminate\Support\Facades\Auth;

class CreateRecordAction extends AbstractAction {
    private $hour_str;

    protected function do(){
        $doctor = $this->model;
        if (!$doctor->isDoctor())
            throw new UserNotDoctorException();

        $this->hour_str = str_pad($this->data['record_time'], 2, '0', STR_PAD_LEFT).':00';

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
        $item->save();

        event(new CreateRecordEvent($item, Auth::user()));

        return $item;
    }

    function checkHour(){
        $date = new DateTime($this->data['record_date']);
        $ar_hour = DoctorFreeHourService::getHour($this->model, $date);

        if ($ar_hour[$this->hour_str] != 'FREE')
            throw new RecordHourBusyException();
    }
}

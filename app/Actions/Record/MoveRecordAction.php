<?php
namespace App\Actions\Record;

use App\Actions\AbstractAction;
use App\Events\ApprovedRecordEvent;
use App\Events\MoveSeanceRecordEvent;
use App\Exceptions\HasNoteAccessException;
use App\Exceptions\Record\CantChangeRecordStatusException;
use App\Exceptions\Record\CantMoveRecordException;
use App\Models\Record\RecordDoctor;
use App\Services\DoctorFreeHourService;
use DateTime;
use Illuminate\Support\Facades\Auth;

class MoveRecordAction extends AbstractAction {
    private $hour_str;

    protected function do(){
        $record = $this->model;

        if ($record->doctor_id != Auth::user()->id)
            throw new HasNoteAccessException();

        if (in_array($record->status_id, [RecordDoctor::DONE_STATUS, RecordDoctor::ON_WORK_STATUS]) )
            throw new CantMoveRecordException();


        $this->hour_str = str_pad($this->data['record_time'], 2, '0', STR_PAD_LEFT).':00';
        $this->checkHour();

        $record->update([
            'is_moved' => true,
            'record_date' => $this->data['record_date'],
            'record_time' => $this->hour_str
        ]);

        event(new MoveSeanceRecordEvent($record, Auth::user()));

        return $record;
    }

    function checkHour(){
        $date = new DateTime($this->data['record_date']);
        $ar_hour = DoctorFreeHourService::getHour($this->model->relDoctor, $date);

        if ($ar_hour[$this->hour_str] != 'FREE')
            throw new RecordHourBusyException();
    }
}

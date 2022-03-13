<?php
namespace  App\Services;

use App\Exceptions\Record\DayOffException;
use App\Exceptions\Record\NoteHasTimetableException;
use App\Models\Record\RecordDoctor;
use App\Models\Timetable\TimetablePlan;
use App\Models\User;
use DateTime;

class DoctorFreeHourService {
    private User $user;
    private DateTime $date;
    private int $day_num;
    private array $doctor_records = [];
    private ?TimetablePlan $timetable;

    function __construct(User $user, DateTime $date){
        $this->date = $date;
        $this->user = $user;
        $this->day_num = $date->format('N');
    }

    static function getHour(User $user, DateTime $date){
        $el = new DoctorFreeHourService($user, $date);
        return $el->calc();
    }

    function calc(): array {
        $this->calcDoctorRecords();
        $this->calcTimetable();

        return $this->calcRes();
    }

    /**
     * @throws NoteHasTimetableException
     * @throws DayOffException
     */
    private function calcRes() : array{
        if (! $this->timetable)
            throw new NoteHasTimetableException();

        if (!$this->timetable->{'day_0'.$this->day_num})
            throw new DayOffException();

        $res = [];

        for ($i = 0; $i <= 23; $i++){
            $i_str = str_pad($i, 2, '0', STR_PAD_LEFT);

            if (!$this->timetable->{'hour_'.$i_str}){
                $res[$i_str.':00'] = 'NOTE_WORKING';
                continue;
            }

            if (isset($this->doctor_records[$i_str.':00'])){
                $res[$i_str.':00'] = 'BUSY';
                continue;
            }

            $res[$i_str.':00'] = 'FREE';
        }

        return  $res;
    }

    private function calcDoctorRecords(){
        $this->doctor_records = RecordDoctor::where(['doctor_id' => $this->user->id, 'record_date' => $this->date->format('Y-m-d')])
                                                ->whereIn('status_id', [RecordDoctor::CREATED_STATUS, RecordDoctor::APPROVED_STATUS,
                                                                        RecordDoctor::ON_WORK_STATUS, RecordDoctor::PAYED_STATUS])
                                                ->where('is_canceled', false)->pluck('record_time')->toArray();
    }

    private function calcTimetable(){
        $this->timetable = TimetablePlan::where('user_id', $this->user->id)->first();
    }
}

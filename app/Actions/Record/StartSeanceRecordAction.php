<?php
namespace App\Actions\Record;

use App\Actions\AbstractAction;
use App\Events\ApprovedRecordEvent;
use App\Events\StartSeanceRecordEvent;
use App\Exceptions\HasNoteAccessException;
use App\Exceptions\Record\CantChangeRecordStatusException;
use App\Models\Record\RecordDoctor;
use Illuminate\Support\Facades\Auth;

class StartSeanceRecordAction extends AbstractAction {

    protected function do(){
        $record = $this->model;

        if ($record->doctor_id != Auth::user()->id)
            throw new HasNoteAccessException();

        if ($record->status_id != RecordDoctor::APPROVED_STATUS)
            throw new CantChangeRecordStatusException();

        $record->update(['status_id' => RecordDoctor::ON_WORK_STATUS]);

        event(new StartSeanceRecordEvent($record, Auth::user()));

        return $record;
    }

}

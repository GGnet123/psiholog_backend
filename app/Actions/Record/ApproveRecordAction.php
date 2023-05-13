<?php
namespace App\Actions\Record;

use App\Actions\AbstractAction;
use App\Events\ApprovedRecordEvent;
use App\Exceptions\HasNoteAccessException;
use App\Exceptions\Record\CantChangeRecordStatusException;
use App\Models\Record\RecordDoctor;
use Illuminate\Support\Facades\Auth;

class ApproveRecordAction extends AbstractAction {

    protected function do(){
        $record = $this->model;

        if ($record->doctor_id != Auth::user()->id)
            throw new HasNoteAccessException();

        if ($record->status_id != RecordDoctor::CREATED_STATUS)
            throw new CantChangeRecordStatusException();

        $record->update(['status_id' => RecordDoctor::APPROVED_STATUS]);

        event(new ApprovedRecordEvent($record, Auth::user()));

        return $record;
    }

}

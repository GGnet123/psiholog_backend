<?php
namespace App\Actions\Record;

use App\Actions\AbstractAction;
use App\Events\CancelRecordEvent;
use App\Exceptions\Record\CantCancelRecordException;
use App\Models\Record\RecordDoctor;
use App\Services\DeclineRecordTransactionSerivce;
use Illuminate\Support\Facades\Auth;

class CancelRecordAction extends AbstractAction {

    protected function do(){
        $record = $this->model;

        if ($record->doctor_id != Auth::user()->id)
            throw new HasNoteAccessException();

        if (in_array($record->status_id, [RecordDoctor::DONE_STATUS, RecordDoctor::ON_WORK_STATUS]))
            throw new CantCancelRecordException();

        $record->update(['is_canceled' => true]);

        event(new CancelRecordEvent($record, Auth::user()));

        DeclineRecordTransactionSerivce::do($record);

        return $record;
    }
}

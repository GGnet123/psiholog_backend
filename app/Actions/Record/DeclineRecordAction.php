<?php
namespace App\Actions\Record;

use App\Actions\AbstractAction;
use App\Exceptions\HasNoteAccessException;
use App\Exceptions\Record\CantChangeRecordStatusException;
use App\Models\Record\RecordDoctor;
use App\Services\DeclineRecordTransactionSerivce;
use Illuminate\Support\Facades\Auth;

class DeclineRecordAction extends AbstractAction {

    protected function do(){
        $record = $this->model;

        if ($record->doctor_id != Auth::user()->id)
            throw new HasNoteAccessException();

        if ($record->status_id != RecordDoctor::CREATED_STATUS)
            throw new CantChangeRecordStatusException();

        $record->update(['status_id' => RecordDoctor::DECLINE_BY_DOCTOR]);

        DeclineRecordTransactionSerivce::do($record);

        return $record;
    }

}

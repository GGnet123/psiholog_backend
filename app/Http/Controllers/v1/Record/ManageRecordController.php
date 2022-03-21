<?php

namespace App\Http\Controllers\v1\Record;

use App\Actions\AbstractAction;
use App\Actions\Record\ApproveRecordAction;
use App\Actions\Record\CancelRecordAction;
use App\Actions\Record\CreateRecordAction;
use App\Actions\Record\DeclineRecordAction;
use App\Actions\Record\FinishRecordAction;
use App\Actions\Record\MoveRecordAction;
use App\Actions\Record\PayRecordAction;
use App\Actions\Record\StartSeanceRecordAction;
use App\Events\ErrorErrorPayRecordEvent;
use App\Events\PayedRecordNotificationEvent;
use App\Exceptions\Record\CurrentUserIsBlockedException;
use App\Exceptions\Record\DoctorIsBlockedException;
use App\Exceptions\Record\RecordIsNotOnWorkException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Record\CreateRecordRequest;
use App\Http\Requests\Record\FreeHourRequest;
use App\Http\Requests\Record\MoveRecordRequest;
use App\Http\Resources\Record\RecordResource;
use App\Models\Record\RecordDoctor;
use App\Models\User;
use App\Services\AgoraService;
use App\Services\DoctorFreeHourService;
use DateTime;
use Illuminate\Http\Request;

class ManageRecordController extends Controller
{
    function getDoctorFreeHour(FreeHourRequest $request, User $doctor){
        if ($doctor->is_blocked_seance)
            throw new DoctorIsBlockedException();
        if ($request->user()->is_blocked_seance)
            throw new CurrentUserIsBlockedException();

        $date =  new DateTime($request->record_date);

        return $this->data_response(DoctorFreeHourService::getHour($doctor, $date));
    }

    function createRecord(CreateRecordRequest $request, User $doctor){
        if ($doctor->is_blocked_seance)
            throw new DoctorIsBlockedException();
        if ($request->user()->is_blocked_seance)
            throw new CurrentUserIsBlockedException();

        try {
            $model = (new CreateRecordAction($doctor, $request->validated()))->run();

            event(new PayedRecordNotificationEvent($model));
        }
        catch (\Exception $exception){
            event(new ErrorErrorPayRecordEvent(new RecordDoctor()));

            throw $exception;
        }


        return new RecordResource($model);
    }

    function approveRecord(RecordDoctor $record){
        $model = (new ApproveRecordAction($record))->run();

        return new RecordResource($model);
    }

    function declineRecord(RecordDoctor $record){
        $model = (new DeclineRecordAction($record))->run();

        return new RecordResource($model);
    }


    function startSeanceRecord(RecordDoctor $record){
        $model = (new StartSeanceRecordAction($record))->run();

        return new RecordResource($model);
    }

    function finishRecord(RecordDoctor $record){
        $model = (new FinishRecordAction($record))->run();

        return new RecordResource($model);
    }

    function moveRecord(MoveRecordRequest $request, RecordDoctor $record){
        $model = (new MoveRecordAction($record, $request->validated()))->run();

        return new RecordResource($model);

    }

    function cancelRecord(RecordDoctor $record){
        $model = (new CancelRecordAction($record))->run();

        return new RecordResource($model);
    }

    function getAgoraData(Request $request, RecordDoctor $record){
        if ($record->status_id != RecordDoctor::ON_WORK_STATUS)
            throw new RecordIsNotOnWorkException();

        $data = AgoraService::token('record_'.$record->id, $request->user()->id);

        return $this->data_response($data);
    }
}

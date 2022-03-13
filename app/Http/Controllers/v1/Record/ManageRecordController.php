<?php

namespace App\Http\Controllers\v1\Record;

use App\Actions\AbstractAction;
use App\Actions\Record\ApproveRecordAction;
use App\Actions\Record\CancelRecordAction;
use App\Actions\Record\CreateRecordAction;
use App\Actions\Record\FinishRecordAction;
use App\Actions\Record\MoveRecordAction;
use App\Actions\Record\PayRecordAction;
use App\Actions\Record\StartSeanceRecordAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Record\CreateRecordRequest;
use App\Http\Requests\Record\FreeHourRequest;
use App\Http\Requests\Record\MoveRecordRequest;
use App\Http\Resources\Record\RecordResource;
use App\Models\Record\RecordDoctor;
use App\Models\User;
use App\Services\DoctorFreeHourService;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ManageRecordController extends Controller
{
    function getDoctorFreeHour(FreeHourRequest $request, User $doctor){
        $date =  new DateTime($request->record_date);

        return $this->data_response(DoctorFreeHourService::getHour($doctor, $date));
    }

    function createRecord(CreateRecordRequest $request, User $doctor){
        $model = (new CreateRecordAction($doctor, $request->validated()))->run();

        return new RecordResource($model);
    }

    function approveRecord(RecordDoctor $record){
        $model = (new ApproveRecordAction($record))->run();

        return new RecordResource($model);
    }

    function payRecord(RecordDoctor $record){
        $model = (new PayRecordAction($record))->run();

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
}

<?php

namespace App\Http\Controllers\v1\Record;

use App\Actions\Record\CreateRecordAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Record\CreateRecordRequest;
use App\Http\Requests\Record\FreeHourRequest;
use App\Http\Resources\Record\RecordResource;
use App\Models\Record\RecordDoctor;
use App\Models\User;
use App\Services\DoctorFreeHourService;
use DateTime;
use Illuminate\Http\Request;

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

    function approveRecord(){

    }

    function payRecord(){

    }

    function startSeanceRecord(){

    }

    function finishRecord(){

    }

    function moveRecord(){

    }

    function cancelRecord(){

    }
}

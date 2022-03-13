<?php

namespace App\Http\Controllers\v1\Record;

use App\Http\Controllers\Controller;
use App\Http\Requests\Record\FilterCustromerRequest;
use App\Http\Requests\Record\FilterDoctorRequest;
use App\Http\Resources\Record\RecordResource;
use App\Models\Record\RecordDoctor;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    function getArStatus(Request $request){
        return $this->data_response(RecordDoctor::getArStatus());
    }

    function doctorRecords(FilterDoctorRequest $request){
        $items = RecordDoctor::where('doctor_id', $request->user()->id)->filter($request)->latest()->paginate(24);

        return RecordResource::collection($items);
    }

    function customerRecords(FilterCustromerRequest $request){
        $items = RecordDoctor::where('customer_id', $request->user()->id)->filter($request)->latest()->paginate(24);

        return RecordResource::collection($items);
    }

    function show(RecordDoctor $record){
        return new RecordResource($record);
    }
}

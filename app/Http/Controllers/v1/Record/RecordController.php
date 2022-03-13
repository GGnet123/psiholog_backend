<?php

namespace App\Http\Controllers\v1\Record;

use App\Http\Controllers\Controller;
use App\Models\Record\RecordDoctor;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    function getArStatus(Request $request){
        return $this->data_response(RecordDoctor::getArStatus());
    }

    function doctorRecords(){

    }

    function customerRecords(){

    }
}

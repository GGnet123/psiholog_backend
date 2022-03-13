<?php

namespace App\Http\Controllers\v1\Record;

use App\Http\Controllers\Controller;
use App\Models\Record\RecordDoctor;
use Illuminate\Http\Request;

class ManageRecordController extends Controller
{
    function getArStatus(Request $request){
        return $this->data(RecordDoctor::getArStatus());
    }

    function getDoctorFreeHour(){

    }

    function createRecord(){

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

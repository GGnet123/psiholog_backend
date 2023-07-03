<?php
namespace App\Http\Controllers\v1\Profile\Doctor;

use App\Actions\MainUpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\Doctor\DoctorSaveTimetablePlanRequest;
use App\Http\Resources\Profile\DoctorTimetablePlanResource;
use Illuminate\Http\Request;

class DoctorTimetablePlanController extends Controller {
    function index(Request $request){
        $doctor = $request->user();
        $doctor->generateDefPlan();

        return new DoctorTimetablePlanResource($doctor->relTimetablePlan);
    }

    function save(DoctorSaveTimetablePlanRequest $request){
        $doctor = $request->user();
        $doctor->generateDefPlan();

        $item = $doctor->relTimetablePlan;

        $model = (new MainUpdateAction($item, $request->validated()))->run();

        return new DoctorTimetablePlanResource($model);
    }
}
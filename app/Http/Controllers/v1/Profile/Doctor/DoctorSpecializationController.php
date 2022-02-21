<?php

namespace App\Http\Controllers\v1\Profile\Doctor;

use App\Actions\MainUpdateAction;
use App\Actions\Profile\LibSpecializationAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\Doctor\DoctorProfileRequest;
use App\Http\Requests\Profile\Doctor\DoctorSpecializationRequest;
use App\Http\Resources\Main\LibSpecializationResource;
use App\Http\Resources\UserResource;
use App\Models\Main\LibSpecialization;
use App\Models\Profile\UserSpecialization;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorSpecializationController extends Controller
{
    function index(Request $request){
        $items = LibSpecialization::whereHas('relUser', function($q) use ($request){
                        $q->where('user_id', $request->user()->id);
                    })->latest()->get();

        return  LibSpecializationResource::collection($items);
    }

    function manyAdd(DoctorSpecializationRequest $request){
        $items = (new LibSpecializationAction(null, $request->validated(), $request))->run();

        return LibSpecializationResource::collection($items);

    }
}

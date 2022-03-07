<?php

namespace App\Http\Controllers\v1\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Main\FilterDoctorRequest;
use App\Http\Resources\Main\DoctorDetailResource;
use App\Http\Resources\Main\DoctorListResource;
use App\Models\User;

class DoctorController extends Controller
{
    function index(FilterDoctorRequest $request){
        return DoctorListResource::collection(
            User::doctor()->filter($request)->paginate(24)
        );
    }

    function item(User $item){
        if (!$item->isDoctor())
            abort(404);

        return new DoctorDetailResource($item);
    }
}

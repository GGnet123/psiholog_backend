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
            User::where('is_blocked_seance', false)->where('is_doctor_approve', true)->doctor()->filter($request)->paginate(24)
        );
    }

    function favorite(FilterDoctorRequest $request){
        return DoctorListResource::collection(
            User::where('is_blocked_seance', false)->where('is_doctor_approve', true)->doctor()->whereHas('relFavorite', function($q) use ($request){
                $q->where('user_id', $request->user()->id)->where('favor_type', 'doctor');
            })->filter($request)->paginate(24)
        );
    }

    function item(User $item){
        if (!$item->isDoctor())
            abort(404);

        return new DoctorDetailResource($item);
    }
}

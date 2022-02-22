<?php

namespace App\Http\Controllers\v1\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Main\FilterMusicGalaryRequest;
use App\Http\Resources\Main\MusicGalaryResource;
use App\Models\Main\MusicGalary;

class MusicGalaryController extends Controller
{
    function index(FilterMusicGalaryRequest $request){
        return MusicGalaryResource::collection(
            MusicGalary::filter($request->validated())->latest()->paginate(24)
        );
    }

    function item(MusicGalary $item){
        return new MusicGalaryResource($item);
    }
}

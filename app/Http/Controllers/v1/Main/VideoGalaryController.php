<?php

namespace App\Http\Controllers\v1\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Main\FilterVideoGalaryRequest;
use App\Http\Resources\Main\VideoGalaryResource;
use App\Models\Main\VideoGalary;

class VideoGalaryController extends Controller
{
    function index(FilterVideoGalaryRequest $request){
        return VideoGalaryResource::collection(
            VideoGalary::filter($request->validated())->latest()->paginate(24)
        );
    }

    function item(VideoGalary $item){
        return new VideoGalaryResource($item);
    }
}

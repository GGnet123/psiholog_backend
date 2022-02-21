<?php

namespace App\Http\Controllers\v1\Main;

use App\Http\Controllers\Controller;
use App\Http\Resources\Main\LibSpecializationResource;
use App\Models\Main\LibSpecialization;
use Illuminate\Http\Request;

class LibSpecializationController extends Controller
{
    function index(){
        return LibSpecializationResource::collection(
            LibSpecialization::latest()->paginate(12)
        );
    }

    function item(LibSpecialization $item){
        return new LibSpecializationResource($item);
    }
}

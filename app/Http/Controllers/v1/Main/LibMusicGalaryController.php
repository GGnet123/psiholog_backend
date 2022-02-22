<?php

namespace App\Http\Controllers\v1\Main;

use App\Http\Controllers\Controller;
use App\Http\Resources\Main\LibMusicGalaryResource;
use App\Models\Main\LibMusicGalary;

class LibMusicGalaryController extends Controller
{
    function index(){
        return LibMusicGalaryResource::collection(
            LibMusicGalary::latest()->paginate(24)
        );
    }

    function item(LibMusicGalary $item){
        return new LibMusicGalaryResource($item);
    }
}

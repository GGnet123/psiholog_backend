<?php

namespace App\Http\Controllers\v1\Main;

use App\Http\Controllers\Controller;
use App\Http\Resources\Main\LibVideoGalaryResource;
use App\Models\Main\LibVideoGalary;

class LibVideoGalaryController extends Controller
{
    function index(){
        return LibVideoGalaryResource::collection(
            LibVideoGalary::latest()->paginate(24)
        );
    }

    function item(LibVideoGalary $item){
        return new LibVideoGalaryResource($item);
    }
}

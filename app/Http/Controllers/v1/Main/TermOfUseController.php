<?php

namespace App\Http\Controllers\v1\Main;

use App\Http\Controllers\Controller;
use App\Http\Resources\Main\TermOfUseResource;
use App\Models\Main\TermOfUse;

class TermOfUseController extends Controller
{
    function index(){
        return new TermOfUseResource(TermOfUse::first());
    }

}

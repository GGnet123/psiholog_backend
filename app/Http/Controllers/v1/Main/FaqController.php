<?php

namespace App\Http\Controllers\v1\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Main\FaqVoteRequest;
use App\Http\Resources\Main\FaqResource;
use App\Models\Main\Faq;
use App\Models\Main\FaqStat;

class FaqController extends Controller
{
    function index(){
        return FaqResource::collection(
            Faq::latest()->paginate(24)
        );
    }

    function item(Faq $item){
        return new FaqResource($item);
    }

    function vote(FaqVoteRequest $request, Faq $item){
        FaqStat::vote($item, $request->user(), $request->vote);

        return new FaqResource($item);
    }
}

<?php

namespace App\Http\Controllers\v1\MainPage;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainPage\FilterCatsRequest;
use App\Http\Requests\MainPage\FilterItemsRequest;
use App\Http\Resources\Content\MainGalaryCatFatResource;
use App\Http\Resources\Content\MainGalaryCatResource;
use App\Http\Resources\Content\MainGalaryResource;
use App\Models\Content\MainGalary;
use App\Models\Content\MainGalaryCat;
use Illuminate\Http\Request;

class GalaryController extends Controller
{
    function index(FilterItemsRequest $request){
        $items = MainGalary::where('type', $request->type);

        if ($request->cat_id)
            $items = $items->where('cat_id', $request->cat_id);

        return MainGalaryResource::collection(
            $items->orderBy('need_subscription', 'asc')->paginate(24)
        );
    }

    function cats(FilterCatsRequest $request){
        $items = MainGalaryCat::where('type', $request->type)->inRandomOrder()->get();

        return MainGalaryCatResource::collection(
            $items
        );
    }

    function types(Request $request){
        return $this->data_response(MainGalary::getArType());
    }

    function mainPage(Request $request){
        $ar_types = MainGalary::getArType();
        $res = [];
        foreach ($ar_types as $type){
            if (in_array($type, [MainGalary::TYPE_MEDITATION, MainGalary::TYPE_YOGA_TO_ME])){
                $types = MainGalaryCatFatResource::collection(MainGalaryCat::where('type', $type)->inRandomOrder()->take(5)->get());
                $items = MainGalaryResource::collection(MainGalary::where('type', $request->type)->inRandomOrder()->take(5)->get());

                $res[$type]['types'] = $types;
                $res[$type]['items'] = $items;
            }

            $res[$type]['items'] = MainGalaryResource::collection(MainGalary::where('type', $type)->inRandomOrder()->take(10)->get());
        }

        return $this->data_response($res);
    }

}

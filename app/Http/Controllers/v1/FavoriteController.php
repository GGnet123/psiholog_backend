<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Favorite\DeleteRequest;
use App\Http\Requests\Favorite\SaveRequest;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    function save(SaveRequest $request){
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        if (!in_array($data['favor_type'], Favorite::getArType()))
            return $this->data_response(false);

        $item = Favorite::where($data)->first();
        if (!$item)
            $item = Favorite::create($data);

        return $this->data_response(true);
    }

    function getArType(){
        return $this->data_response(Favorite::getArType());
    }

    function delete(DeleteRequest $request){
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $item = Favorite::where($data)->first();
        if ($item)
            $item->delete();

        return $this->data_response([true]);
    }

}

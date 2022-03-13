<?php
namespace App\Traits;

trait ApiResponse {
    function true($message, $data = false, $add_data = false){
        $res = [];
        $res['success'] = true;
        $res['message'] = $message;

        if ($data)
            $res['result'] = $data;

        if ($add_data)
            $res['additional_data'] = $add_data;

        return response()->json($res, 200);
    }

    function data($data){
        $res = [];
        $res['data'] = $data;

        return response()->json($res, 200);
    }

    function noContent(){
        return response()->json(true, 200);
    }

    function false($message, $data = false){
        $res = [];
        $res['success'] = false;
        $res['message'] = $message;

        if ($data)
            $res['result'] = $data;

        return response()->json($res, 400);
    }


    function forbidden(){
        $res = [];
        $res['success'] = false;
        $res['message'] = 'Forbidden ';

        return response()->json($res, 403);
    }
}

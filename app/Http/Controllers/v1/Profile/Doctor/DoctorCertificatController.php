<?php

namespace App\Http\Controllers\v1\Profile\Doctor;

use App\Actions\MainDeleteAction;
use App\Actions\MainStoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\Doctor\DoctorCertificatRequest;
use App\Http\Resources\Profile\DoctorCertificat;
use App\Models\Profile\UserCertificat;
use Illuminate\Http\Request;

class DoctorCertificatController extends Controller
{
    function index(Request $request){
        $items = UserCertificat::where('user_id', $request->user()->id)->latest()->get();

        return  DoctorCertificat::collection($items);
    }

    function save(DoctorCertificatRequest $request){
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        $item = (new MainStoreAction(new UserCertificat(), $data))->run();

        return new DoctorCertificat($item);

    }

    function destroy(UserCertificat $user_certificat){
        (new MainDeleteAction($user_certificat))->run();

        return $this->noContent();
    }
}

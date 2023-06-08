<?php

namespace App\Http\Controllers\v1\Services;

use App\Actions\MainDeleteAction;
use App\Actions\Services\DropBoxAction;
use App\Actions\Services\UploadFileAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Services\Uploader\DropBoxRequest;
use App\Http\Requests\Services\Uploader\ImageRequest;
use App\Http\Requests\Services\Uploader\MusicRequest;
use App\Http\Requests\Services\Uploader\VideoRequest;
use App\Http\Resources\Services\UploaderFileResource;
use App\Models\Services\UploaderFile;
use http\Client\Response;

class UploaderFileController extends Controller {
    function dropbox(DropBoxRequest $request){
        $data = $request->validated();
        $data['type_id'] = UploaderFile::DROPBOX;

        $model = (new DropBoxAction(null, $data, $request))->run();

        return new UploaderFileResource($model);
    }

    function music(MusicRequest $request){
        ini_set('upload_max_filesize', '30M');


        $data = $request->validated();
        $data['type_id'] = UploaderFile::IMAGE;

        $model = (new UploadFileAction(null, $data, $request))->run();

        return new UploaderFileResource($model);
    }

    function video(VideoRequest $request){
        ini_set('upload_max_filesize', '30M');

        $data = $request->validated();
        $data['type_id'] = UploaderFile::IMAGE;

        $model = (new UploadFileAction(null, $data, $request))->run();

        return new UploaderFileResource($model);

    }

    function image(ImageRequest $request){
        ini_set('upload_max_filesize', '30M');

        $data = $request->validated();
        $data['type_id'] = UploaderFile::IMAGE;

        $model = (new UploadFileAction(null, $data, $request))->run();

        return new UploaderFileResource($model);
    }

    function destroy(UploaderFile $file){
        (new MainDeleteAction($file))->run();

        return $this->noContent();
    }

    function contract() {
        $path = 'store/contract/contract.pdf';
        return response()->file($path, ['Content-Type' => 'application/pdf']);
    }
}

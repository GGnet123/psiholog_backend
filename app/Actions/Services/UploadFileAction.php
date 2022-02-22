<?php
namespace App\Actions\Services;

use App\Actions\AbstractAction;
use App\Models\Services\UploaderFile;
use Illuminate\Support\Str;

class UploadFileAction extends AbstractAction {
    protected function do(){
        $file = $this->request->file('upload_file');

        $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $file_name = Str::slug($file_name);

        $file_path = $file->storeAs(
            'public/store/'.date('Y').'/'.date('m').'/'.date('d').'/'.rand(1000, 9999),
            $file_name.'.'.$file->getClientOriginalExtension());

        $size = $file->getSize();

        $title = $this->request->title && $this->request->title != '' ? $this->request->title : $file->getClientOriginalName();

        $this->model = UploaderFile::create([
            'path' => $file_path,
            'filesize' => $size,
            'filename' => $file_name,
            'extension' => $file->getClientOriginalExtension(),
            'title' => $title,
            'type_id' => $this->data['type_id']]);

        return $this->model;
    }
}
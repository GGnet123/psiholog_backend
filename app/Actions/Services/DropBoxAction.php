<?php
namespace App\Actions\Services;

use App\Actions\AbstractAction;
use App\Models\Services\UploaderFile;
use Illuminate\Support\Str;

class DropBoxAction extends AbstractAction {
    protected function do(){
        $path_info = pathinfo($this->request->link);

        $this->model = UploaderFile::create([
            'path' => $this->request->link,
            'filesize' => '0',
            'filename' => $path_info['basename'],
            'extension' => $path_info['extension'],
            'title' => ($this->request->title ? $this->request->title : $path_info['basename']),
            'type_id' => $this->data['type_id']]);

        return $this->model;
    }
}

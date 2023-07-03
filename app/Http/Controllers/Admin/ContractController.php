<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Services\UploaderFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContractController extends Controller
{
    protected $view_path = 'page.contract';
    public function index() {
        $path = 'store/contract/contract.pdf';
        $file = Storage::get($path);
        return view($this->view_path, [
            'title' => __('sidebar.contract'),
            'hasContract' => (bool)$file,
            'filePath' => $path
        ]);
    }

    public function upload(Request $request) {
        $file = $request->file('file');
        $file_name = 'contract';
        $file_name = Str::slug($file_name);

        $file_path = $file->storeAs(
            'store/contract',
            $file_name.'.'.$file->getClientOriginalExtension());

        $size = $file->getSize();

        $title = $file->getClientOriginalName();

        $model = UploaderFile::create([
            'path' => $file_path,
            'filesize' => $size,
            'filename' => $file_name,
            'extension' => $file->getClientOriginalExtension(),
            'title' => $title,
            'type_id' => UploaderFile::DOCUMENT
        ]);

        return true;
    }
}

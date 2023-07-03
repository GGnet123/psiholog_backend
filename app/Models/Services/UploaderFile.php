<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploaderFile extends Model
{
    use HasFactory;
    protected $table = 'uploaded_file';
    protected $fillable = [
        'path', 'filesize', 'filename', 'extension', 'title', 'type_id'
    ];

    CONST MUSIC = 1;
    CONST VIDEO = 2;
    CONST IMAGE = 3;
    CONST DROPBOX = 4;
    CONST DOCUMENT = 5;
}

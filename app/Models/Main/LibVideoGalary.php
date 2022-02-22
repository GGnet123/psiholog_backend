<?php

namespace App\Models\Main;

use App\Models\Services\UploaderFile;
use App\Traits\TranslateModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibVideoGalary extends Model
{
    use HasFactory, TranslateModelTrait;
    protected $table = 'video_galary_cat';
    protected $fillable = [
        'name',
        'name_en',
        'photo_id',
        'is_free',
    ];

    protected $casts = [
        'is_free' => 'boolean'
    ];

    function relPhoto(){
        return $this->belongsTo(UploaderFile::class, 'photo_id');
    }


}

<?php

namespace App\Models\Main;

use App\Models\Services\UploaderFile;
use App\Traits\TranslateModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MusicGalary extends Model
{
    use HasFactory, TranslateModelTrait;
    protected $table = 'music_galary';
    protected $fillable = [
        'name',
        'name_en',
        'photo_id',
        'is_free',
        'cat_id',
        'music_id'
    ];

    protected $casts = [
        'is_free' => 'boolean'
    ];

    function scopeFilter($q, array $ar){
        if (isset($ar['cat_id']) && $ar['cat_id'])
            $q->where('cat_id', $ar['cat_id']);
    }

    function relPhoto(){
        return $this->belongsTo(UploaderFile::class, 'photo_id');
    }

    function relCat(){
        return $this->belongsTo(LibMusicGalary::class, 'cat_id');
    }

    function relMusic(){
        return $this->belongsTo(UploaderFile::class, 'music_id');
    }


}

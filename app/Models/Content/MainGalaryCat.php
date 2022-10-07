<?php

namespace App\Models\Content;

use App\Models\Services\UploaderFile;
use App\Models\User;
use App\Traits\FilterModelTrait;
use App\Traits\LabelModelTrait;
use App\Traits\SortModelTrait;
use App\Traits\TranslateModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MainGalaryCat extends Model
{
    use HasFactory, TranslateModelTrait, LabelModelTrait, SortModelTrait, FilterModelTrait, Notifiable;
    protected $table = 'content_main_gallery_cat';
    protected $fillable = [
        'title',
        'title_en',
        'image_id',
        'type',
        'need_subscription'
    ];

    protected $ar_filter = [
        'title' => 'string',
    ];

    protected $casts = [
        'need_subscription' => 'boolean'
    ];

    function relImage(){
        return $this->belongsTo(UploaderFile::class, 'image_id');
    }

    function relGalary(){
        return $this->hasMany(MainGalary::class, 'cat_id');
    }



    function relFavorite(){
        return $this->hasMany(Favorite::class, 'el_id');
    }
}

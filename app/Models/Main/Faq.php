<?php

namespace App\Models\Main;

use App\Traits\FilterModelTrait;
use App\Traits\LabelModelTrait;
use App\Traits\SortModelTrait;
use App\Traits\TranslateModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory, TranslateModelTrait, LabelModelTrait, SortModelTrait, FilterModelTrait;
    protected $table = 'faq';
    protected $fillable = [
        'name',
        'name_en',
        'note',
        'note_en'
    ];

    protected $ar_filter = [
        'name' => 'string',
        'name_en' => 'string',
        'note' => 'string',
        'note_en' => 'string'
    ];

    protected $ar_sort = [
        'name',
        'name_en',
    ];

    function relStat(){
        return $this->hasMany(FaqStat::class, 'faq_id');
    }

    function getGoodCount(){
        return $this->relStat()->where('is_good', true)->count();
    }

    function getBadCount(){
        return $this->relStat()->where('is_good', false)->count();
    }



}

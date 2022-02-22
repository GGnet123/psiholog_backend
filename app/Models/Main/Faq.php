<?php

namespace App\Models\Main;

use App\Traits\TranslateModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory, TranslateModelTrait;
    protected $table = 'faq';
    protected $fillable = [
        'name',
        'name_en',
        'note',
        'note_en'
    ];

}

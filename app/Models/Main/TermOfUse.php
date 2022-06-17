<?php

namespace App\Models\Main;

use App\Traits\LabelModelTrait;
use App\Traits\TranslateModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermOfUse extends Model
{
    use HasFactory, TranslateModelTrait, LabelModelTrait;
    protected $table = 'term_of_use';
    protected $fillable = [
        'note',
        'note_en'
    ];

}

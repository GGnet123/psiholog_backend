<?php

namespace App\Models\Main;

use App\Models\Services\UploaderFile;
use App\Models\User;
use App\Traits\FilterModelTrait;
use App\Traits\LabelModelTrait;
use App\Traits\SortModelTrait;
use App\Traits\TranslateModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory, TranslateModelTrait, LabelModelTrait, SortModelTrait, FilterModelTrait;
    protected $table = 'claim_user';
    protected $fillable = [
        'user_id',
        'note',
        'file_id',
        'is_done',
        'from_user_id'
    ];

    protected $ar_filter = [
        'note' => 'string',
        'user_id' => 'int'
    ];

    function relFile(){
        return $this->belongsTo(UploaderFile::class, 'file_id');
    }

    function relUser(){
        return $this->belongsTo(User::class, 'user_id');
    }


}

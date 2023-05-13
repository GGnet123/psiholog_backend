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
use Illuminate\Notifications\Notifiable;

class Claim extends Model
{
    use HasFactory, TranslateModelTrait, LabelModelTrait, SortModelTrait, FilterModelTrait, Notifiable;
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
        'user_id' => 'int',
        'user_name' => 'function',
        'from_user_name' => 'function',
        'is_done' => 'boolean_str',
    ];

    function relFile(){
        return $this->belongsTo(UploaderFile::class, 'file_id');
    }

    function relUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    function relFromUser(){
        return $this->belongsTo(User::class, 'from_user_id');
    }

    function scopeFromUserName($q, $name){
        return $q->whereHas('relFromUser', function($b) use ($name){
            $b->where('name', 'like', '%'.$name.'%');
        });
    }

    function scopeUserName($q, $name){
        return $q->whereHas('relUser', function($b) use ($name){
            $b->where('name', 'like', '%'.$name.'%');
        });
    }


}

<?php

namespace App\Models\Main;

use App\Models\Services\UploaderFile;
use App\Models\User;
use App\Traits\FilterModelTrait;
use App\Traits\LabelModelTrait;
use App\Traits\SortModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Support extends Model
{
    use HasFactory, LabelModelTrait, SortModelTrait, FilterModelTrait, Notifiable;
    protected $table = 'support';
    protected $fillable = [
        'name',
        'note',
        'file_id',
        'from_user_id',
        'is_closed',
        'answer'
    ];

    protected $casts = [
        'is_closed' => 'boolean'
    ];

    protected $ar_filter = [
        'name' => 'string'
    ];

    function relFile(){
        return $this->belongsTo(UploaderFile::class, 'file_id');
    }

    function relFromUser(){
        return $this->belongsTo(User::class, 'from_user_id');
    }

}

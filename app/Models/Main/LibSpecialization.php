<?php

namespace App\Models\Main;

use App\Models\Profile\UserSpecialization;
use App\Traits\TranslateModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibSpecialization extends Model
{
    use HasFactory, TranslateModelTrait;
    protected $table = 'lib_specialization';
    protected $fillable = [
        'name',
        'name_en'
    ];

    function relUser(){
        return $this->hasMany(UserSpecialization::class, 'lib_specialization_id');
    }


}
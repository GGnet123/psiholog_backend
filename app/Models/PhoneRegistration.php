<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneRegistration extends Model
{
    use HasFactory;
    protected $table = 'phone_registration';
    protected $fillable = [
        'phone', 'pin', 'accepted'
    ];

    protected $casts = [
        'accepted' => 'boolean'
    ];


    function generatePin(){
        $this->pin = 123456;
    }

}

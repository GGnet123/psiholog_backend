<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailRegistration extends Model
{
    use HasFactory;
    protected $table = 'email_registration';
    protected $fillable = [
        'email', 'pin', 'accepted'
    ];

    protected $casts = [
        'accepted' => 'boolean'
    ];
}

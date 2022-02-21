<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'login',
        'password',
        'type_id',
        'lang',
        'date_b',
        'avatar_id',
        'note',
        'price',
        'notify_all',
        'notify_meditation',
        'notify_app'
    ];

    CONST ADMIN_TYPE = 1;
    CONST DOCTOR_TYPE = 2;
    CONST USER_TYPE = 3;
    CONST NOTE_FINISHED_TYPE = 4;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];


    function isAdmin():bool {
        return $this->type_id == STATIC::ADMIN_TYPE;
    }

    function isDoctor():bool {
        return $this->type_id == STATIC::DOCTOR_TYPE;
    }

    function isUser():bool {
        return $this->type_id == STATIC::USER_TYPE;
    }

    function isNoteFinishRegistration():bool {
        return $this->type_id == STATIC::NOTE_FINISHED_TYPE;
    }
}

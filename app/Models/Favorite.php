<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Favorite extends Model
{
    use HasFactory;
    protected $table = 'favorites';
    protected $fillable = [
        'user_id', 'favor_type', 'el_id'
    ];

    function relUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    static function getArType(){
        return [
            'doctor'
        ];
    }

    static function getFavorBool(string $type, int $el_id) : bool {
        $item = Favorite::where(['user_id' => Auth::user()->id, 'favor_type' => $type, 'el_id' => $el_id])->count();

        return ( $item ? true : false);
    }

}

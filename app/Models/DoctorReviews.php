<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorReviews extends Model
{
    protected $table = 'doctor_reviews';
    protected $fillable = [
        'rate', 'comment', 'user_id', 'doctor_id'
    ];

    function relDoctor() {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    function relUser() {
        return $this->belongsTo(User::class, 'user_id');
    }
}

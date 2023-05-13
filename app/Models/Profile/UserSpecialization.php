<?php
namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;

class UserSpecialization extends Model {
    protected $table = 'users_specialization';
    protected $fillable = ['user_id', 'lib_specialization_id'];
}
<?php

namespace App\Models\Main;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqStat extends Model
{
    use HasFactory;
    protected $table = 'faq_stat';
    protected $fillable = [
        'faq_id',
        'user_id',
        'is_good'
    ];

    static function vote(Faq $item, User $user, bool $vote){
        $item = FaqStat::firstOrCreate(['faq_id' => $item->id, 'user_id' => $user->id]);
        $item->update(['is_good' => $vote]);
    }

}

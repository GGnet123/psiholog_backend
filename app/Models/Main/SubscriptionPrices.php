<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPrices extends Model
{
    protected $table = 'subscription_prices';
    protected $fillable = [
        'month_price', 'year_price'
    ];
}

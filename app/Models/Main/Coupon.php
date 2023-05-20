<?php

namespace App\Models\Main;

use App\Traits\FilterModelTrait;
use App\Traits\LabelModelTrait;
use App\Traits\SortModelTrait;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    const TRIES_COUNT = 10;
    use LabelModelTrait, SortModelTrait, FilterModelTrait;
    protected $table = 'coupons';
    protected $fillable = [
        'code', 'is_used', 'sum'
    ];

    protected $ar_sort = [
        'sum', 'is_used'
    ];

    protected $ar_filter = [
        'sum' => 'int',
        'code' => 'string',
        'is_used' => 'boolean_str',
    ];

    public static function generateCode(): string
    {
        $tries = 0;
        while (true) {
            $code = substr(md5(time()), 0, 10);
            $coupon = Coupon::where('code', $code)->first();
            if (!$coupon) {
                break;
            }
            if ($tries >= self::TRIES_COUNT) {
                throw new \Exception("Couldn't create unique code");
            }
            $tries++;
        }
        return $code;
    }
}

<?php
namespace App\Traits;

use Illuminate\Support\Str;

trait FilterModelTrait {
    function scopeFilter($q, $request){
        $ar_filter = (is_array($this->ar_filter) ? $this->ar_filter : []);

        $ar_filter['id'] = 'int';


        foreach ($request->all() as $k => $v){
            if (!isset($ar_filter[$k]))
                continue;

            if ($ar_filter[$k] == 'string' && trim($k) != '')
                $q->where($k, 'like', '%'.$v.'%');

            if ($ar_filter[$k] == 'date' && $date = New \DateTime()) {
                $q->where($k, 'like', '%' . $date->format('d-m-Y') . '%');
            }

            if ($ar_filter[$k] == 'int' && $v > 0)
                $q->where($k, $v);

            if ($ar_filter[$k] == 'boolean' && $v)
                $q->where($k, true);

            if ($ar_filter[$k] == 'boolean' && !$v)
                $q->where($k, false);

            if ($ar_filter[$k] == 'boolean_str' && $v == 'Y')
                $q->where($k, true);

            if ($ar_filter[$k] == 'boolean_str' && $v == 'N')
                $q->where($k, false);

            if ($ar_filter[$k] == 'function' && $v) {
                $func = Str::camel($k);
                $q->{$func}($v);
            }

        }

        return $q;
    }
}

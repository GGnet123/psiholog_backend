<?php
namespace App\Traits;

trait FilterModelTrait {
    function scopeFilter($q, $request){
        $ar_filter = (is_array($this->ar_filter) ? $this->ar_filter : []);

        $ar_filter['id'] = 'int';


        foreach ($request->all() as $k => $v){
            if (!isset($ar_filter[$k]))
                continue;

            if ($ar_filter[$k] == 'string' && trim($k) != '')
                $q->where($k, 'like', '%'.$v.'%');

            if ($ar_filter[$k] == 'int' && $v > 0)
                $q->where($k, $v);

        }

        return $q;
    }
}
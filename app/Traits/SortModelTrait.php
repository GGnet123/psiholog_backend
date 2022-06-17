<?php
namespace App\Traits;


trait SortModelTrait {
    function scopeSort($q, $request){
        $ar_sort = (is_array($this->ar_sort) ? $this->ar_sort : []);

        $ar_sort[] = 'id';
        $ar_sort[] = 'created_at';
        $ar_sort[] = 'updated_at';


        if (in_array($request->sort, $ar_sort) && $request->sort_by == 'desc')
            $q->orderBy($request->sort, 'desc');
        else if (in_array($request->sort, $ar_sort) && $request->sort_by == 'asc')
            $q->orderBy($request->sort, 'asc');
        else
            $q->orderBy('id', 'desc');

        return $q;
    }
}
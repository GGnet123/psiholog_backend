<?php

function getSortLink($ar_request, $attr){
    $ar = [];
    foreach ($ar_request as $k => $v){
        if (is_array($v))
            continue;

        if ($attr == $k)
            continue;

        if (in_array($k, ['page', 'sort', 'sort_by']))
            continue;

        $ar[$k] = $v;
    }
    $ar['save_filter'] = 1;

    if (isset($ar_request['sort']) && isset($ar_request['sort_by']) && $ar_request['sort'] == $attr && $ar_request['sort_by'] == 'desc'){
        $ar['sort'] = $attr;
        $ar['sort_by'] = 'asc';
    }
    else {
        $ar['sort'] = $attr;
        $ar['sort_by'] = 'desc';
    }

    return http_build_query($ar);
}

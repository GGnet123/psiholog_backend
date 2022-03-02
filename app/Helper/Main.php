<?php
function checkFilterParam($request){
    $url = $request->url();
    $ar_param = $request->all();

    if (count($ar_param) > 0 && ($request->save_filter == 1 || $request->page > 0)){

        $saved = str_replace("save_filter=1", "", $request->fullUrl());

        session(['filter_'.$url => $saved]);
        session()->save();

        return false;
    }

    if ($request->clear_filter == 1){
        session()->forget('filter_'.$url);
        session()->save();

        return redirect()->to($url);
    }

    if (count($ar_param) == 0 && session('filter_'.$url)) {
        return redirect()->to(session('filter_'.$url));
    }


    return false;
}

function getSortLink($request, $attr){
    $ar = [];
    foreach ($request->all() as $k => $v){
        if (is_array($v))
            continue;

        if ($attr == $k)
            continue;

        if (in_array($k, ['page', 'sort', 'sort_by']))
            continue;

        $ar[$k] = $v;
    }
    $ar['save_filter'] = 1;

    if ($request->sort == $attr && $request->sort_by == 'desc'){
        $ar['sort'] = $attr;
        $ar['sort_by'] = 'asc';
    }
    else {
        $ar['sort'] = $attr;
        $ar['sort_by'] = 'desc';
    }

    return http_build_query($ar);
}

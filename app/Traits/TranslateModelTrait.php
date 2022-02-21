<?php
namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait  TranslateModelTrait {
    function trans(String $attr){
        $lang = Auth::user()->lang;

        if ($lang == 'en')
            return $this->{$attr.'_en'};

        return $this->{$attr};
    }
}
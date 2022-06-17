<?php
namespace App\Traits;


trait LabelModelTrait {
    function label(String $field){
        if ($field == 'id')
            return $field;

        if ($field == 'created_at' || $field == 'created_cool')
            return __('model.created_at');

        if ($field == 'updated_at' || $field == 'updated_cool')
            return __('model.updated_at');

        if ($field == 'edited_user_id')
            return __('model.edited_user_id');

        return __('model.'.$this->getTable().'.'.$field);
    }
}
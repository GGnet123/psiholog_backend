<?php
namespace App\Actions;

class MainUpdateAction extends AbstractAction{
    protected function do(){
        $this->model->fill($this->data);
        $this->model->save();

        return $this->model;
    }
}
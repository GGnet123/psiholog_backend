<?php
namespace App\Actions;

class MainDeleteAction extends AbstractAction{
    protected function do(){
        $this->model->delete();
    }
}
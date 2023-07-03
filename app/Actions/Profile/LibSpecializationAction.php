<?php
namespace App\Actions\Profile;

use App\Actions\AbstractAction;
use App\Models\Main\LibSpecialization;
use App\Models\Profile\UserSpecialization;

class LibSpecializationAction extends AbstractAction {
    protected function do(){
        $request = $this->request;
        $data = $this->data;
        if (isset($data['user_id']) && isset($data['specialization_array'])) {
            $userId = $data['user_id'];
        } else {
            $userId = $request->user()->id;
        }
        $specializations = $this->data['specialization_array'];
        UserSpecialization::where('user_id', $userId)->delete();

        foreach ($specializations as $id){
            UserSpecialization::create([
                'user_id' => $userId,
                'lib_specialization_id' => $id
            ]);
        }

        $items = LibSpecialization::whereHas('relUser', function($q) use ($userId){
            $q->where('user_id', $userId);
        })->latest()->get();

        return $items;
    }
}
<?php
namespace App\Actions\Profile;

use App\Actions\AbstractAction;
use App\Models\Main\LibSpecialization;
use App\Models\Profile\UserSpecialization;

class LibSpecializationAction extends AbstractAction {
    protected function do(){
        $request = $this->request;

        UserSpecialization::where('user_id', $request->user()->id)->delete();

        foreach ($this->data['specialization_array'] as $id){
            UserSpecialization::create([
                'user_id' => $request->user()->id,
                'lib_specialization_id' => $id
            ]);
        }

        $items = LibSpecialization::whereHas('relUser', function($q) use ($request){
            $q->where('user_id', $request->user()->id);
        })->latest()->get();

        return $items;
    }
}
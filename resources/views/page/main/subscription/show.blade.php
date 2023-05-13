@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">
        <x-form.show :title="$title" :model="$model">
            <x-show.def name="user_id"  :model="$model" :value="$model->relUser ? $model->relUser->name : null"  />
            <x-show.def name="is_active"  :model="$model"  :value="$model->is_active ? 'Да' : 'Нет'"  />
            <x-show.def name="date_e"  :model="$model"   />
            <x-show.def name="type_ru"  :model="$model" :value="$model->type_ru"   />
            <x-show.def name="is_cancel_by_user"  :model="$model"  :value="$model->is_cancel_by_user ? 'Да' : 'Нет'"  />
            <x-show.def name="is_cancel_by_system"  :model="$model"  :value="$model->is_cancel_by_system ? 'Да' : 'Нет'"  />
        </x-form.show>
    </div>
@endsection

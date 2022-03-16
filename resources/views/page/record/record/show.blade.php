@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">
        <x-form.show :title="$title" :model="$model">
            <x-show.def name="customer_id"  :model="$model" :value="$model->relCustomer ? $model->relCustomer->name : null"  />
            <x-show.def name="doctor_id"  :model="$model" :value="$model->relDoctor ? $model->relDoctor->name : null"  />
            <x-show.def name="sum"  :model="$model"   />
            <x-show.def name="record_date"  :model="$model"   />
            <x-show.def name="record_time"  :model="$model"   />
            <x-show.def name="status_id"  :model="$model" :value="$model->status_ru"   />
            <x-show.def name="is_canceled"  :model="$model"  :value="$model->is_canceled ? 'Да' : 'Нет'"  />
            <x-show.def name="is_moved"  :model="$model"  :value="$model->is_moved ? 'Да' : 'Нет'"  />
        </x-form.show>
    </div>
@endsection

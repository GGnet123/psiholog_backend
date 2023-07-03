@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">

        <x-form.show :title="$title" :model="$model">
            <x-show.def name="cat_id"  :model="$model" :value="$model->relCat ? $model->relCat->titlle : $model->label('null_cat')"   />
            <x-show.def name="title"  :model="$model"   />
            <x-show.def name="title_en"  :model="$model"   />
            <x-show.def name="google_drive_video"  :model="$model"   />
            <x-show.def name="need_subscription"  :model="$model"  :value="$model->need_subscription ? 'Да' : 'Нет'"  />
        </x-form.show>
    </div>
@endsection

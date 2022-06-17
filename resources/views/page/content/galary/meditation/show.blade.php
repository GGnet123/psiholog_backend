@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">

        <x-form.show :title="$title" :model="$model">
            <x-show.def name="cat_id"  :model="$model" :value="$model->relCat ? $model->relCat->name : $model->label('null_cat')"   />
            <x-show.def name="title"  :model="$model"   />
            <x-show.file name="music_id"  :model="$model" :value="$model->relMusic"  />
            <x-show.def name="need_subscription"  :model="$model"  :value="$model->need_subscription ? 'Да' : 'Нет'"  />
        </x-form.show>
    </div>
@endsection

@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">

        <x-form.show :title="$title" :model="$model">
            <x-show.def name="title"  :model="$model"   />
            <x-show.file name="music_id"  :model="$model" :value="$model->relMusic"  />
            <x-show.file name="image_id"  :model="$model" :value="$model->relImage"  />
        </x-form.show>
    </div>
@endsection

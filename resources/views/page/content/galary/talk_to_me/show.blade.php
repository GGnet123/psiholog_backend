@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">

        <x-form.show :title="$title" :model="$model">
            <x-show.def name="title"  :model="$model"   />
            <x-show.def name="slug"  :model="$model"   />
            <x-show.file name="video_id"  :model="$model" :value="$model->relVideo"  />
            <x-show.file name="image_id"  :model="$model" :value="$model->relImage"  />
        </x-form.show>
    </div>
@endsection

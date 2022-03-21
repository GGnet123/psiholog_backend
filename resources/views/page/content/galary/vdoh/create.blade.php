@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">
        <x-form.create :title="$title" :action="route($route_path.'_create_save')">
            <x-input.text name="title" :model="$model" required  />
            <x-input.file name="video_id"  :model="$model" type="video" required  />
            <x-input.file name="image_id"  :model="$model" required  />
        </x-form.create>
    </div>
@endsection

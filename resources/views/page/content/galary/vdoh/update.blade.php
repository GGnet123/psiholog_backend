@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">
        <x-form.update :title="$title" :action="route($route_path.'_update_save', $model)">
            <x-input.text name="title" :model="$model" required  />
            <x-input.file name="video_id"  :model="$model" type="video" required  />
            <x-input.file name="image_id"  :model="$model" required  />
        </x-form.update>
    </div>
@endsection

@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">
        <x-form.create :title="$title" :action="route($route_path.'_create_save')">
            <x-input.text name="title" :model="$model" required  />
            <x-input.text name="title_en" :model="$model" required  />
{{--            <x-input.text name="slug" :model="$model" required  />--}}
{{--            <x-input.text name="slug_en" :model="$model" required  />--}}
            <x-input.file name="image_id"  :model="$model" required  />
{{--            <x-input.text name="google_drive_video" :model="$model" required  />--}}
{{--            <x-input.bool name="need_subscription"  :model="$model" required  />--}}
        </x-form.create>
    </div>
@endsection

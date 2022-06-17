@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">
        <x-form.update :title="$title" :action="route($route_path.'_update_save', $model)">
            <x-input.text name="title" :model="$model" required  />
            <x-input.text name="title_en" :model="$model" required  />
            <x-input.text name="google_drive_music" :model="$model" required  />
            <x-input.text name="google_drive_video" :model="$model" required  />
            <x-input.bool name="need_subscription"  :model="$model" required  />
        </x-form.update>
    </div>
@endsection

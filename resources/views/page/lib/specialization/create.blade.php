@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">
        <x-form.create :title="$title" :action="route($route_path.'_create_save')">
            <x-input.text name="name" :model="$model" required  />
            <x-input.text name="name_en"  :model="$model" required  />
        </x-form.create>
    </div>
@endsection
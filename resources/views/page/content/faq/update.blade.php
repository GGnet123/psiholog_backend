@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">
        <x-form.update :title="$title" :action="route($route_path.'_update_save', $model)">
            <x-input.text name="name" :model="$model" required  />
            <x-input.text name="name_en"  :model="$model" required  />
            <x-input.textarea name="note" :model="$model" required  />
            <x-input.textarea name="note_en" :model="$model" required  />
        </x-form.update>
    </div>
@endsection
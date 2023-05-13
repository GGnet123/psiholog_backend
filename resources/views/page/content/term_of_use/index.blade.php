@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">
        <x-form.update :title="$title" :action="route($route_path.'_save', $model)">
            <x-input.textarea name="note" :model="$model" required  />
            <x-input.textarea name="note_en" :model="$model" required  />
        </x-form.update>
    </div>
@endsection
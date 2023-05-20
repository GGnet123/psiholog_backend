@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">
        <x-form.create :title="$title" :action="route($route_path.'_create_save')">
            <x-input.text name="code" :model="$model" required disabled="disabled"  />
            <input type="hidden" name="code" value="{{$model->code}}">
            <x-input.text name="sum"  :model="$model" required  />
        </x-form.create>
    </div>
@endsection



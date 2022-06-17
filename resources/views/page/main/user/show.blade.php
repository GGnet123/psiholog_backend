@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">

        <x-form.show :title="$title" :model="$model">
            <x-show.def name="name"  :model="$model"   />
            <x-show.def name="login"  :model="$model"   />
            <x-show.def name="lang"  :model="$model"   />
            <x-show.file name="avatar_id"  :model="$model"  :value="$model->relAvatar"  />
        </x-form.show>
    </div>
@endsection
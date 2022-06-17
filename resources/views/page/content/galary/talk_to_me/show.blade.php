@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">

        <x-form.show :title="$title" :model="$model">
            <x-show.def name="title"  :model="$model"   />
            <x-show.def name="title_en"  :model="$model"   />
            <x-show.def name="slug"  :model="$model"   />
            <x-show.def name="slug_en"  :model="$model"   />
            <x-show.def name="google_drive_music"  :model="$model"   />
            <x-show.def name="google_drive_video"  :model="$model"   />
            <x-show.def name="need_subscription"  :model="$model"  :value="$model->need_subscription ? 'Да' : 'Нет'"  />
        </x-form.show>
    </div>
@endsection

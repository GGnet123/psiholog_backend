@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">

        <x-form.show :title="$title" :model="$model">
            <x-show.def name="name"  :model="$model"   />
            <x-show.def name="name_en"  :model="$model"   />
            <x-show.def name="note"  :model="$model"   />
            <x-show.def name="note_en"  :model="$model"   />
            <x-show.def name="good_count"  :model="$model" :value="$model->getGoodCount()"   />
            <x-show.def name="bad_count"  :model="$model" :value="$model->getBadCount()"   />
        </x-form.show>
    </div>
@endsection
@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">

        <x-form.show :title="$title" :model="$model">
            <x-show.def name="name"  :model="$model"   />
            <x-show.def name="name_en"  :model="$model"   />
            <x-show.def name="note"  :model="$model"   />
            <x-show.def name="note_en"  :model="$model"   />
        </x-form.show>
    </div>
@endsection
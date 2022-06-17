@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">
        <x-form.update :title="$title" :action="route($route_path.'_update_save', $model)">
            <x-input.select name="cat_id" :model="$model"  :ar="[null=>$model->label('null_cat')] + App\Models\Content\MainGalaryCat::where('type', 'TYPE_MEDITATION')->pluck('id', 'title')->toArray()" />
            <x-input.text name="title" :model="$model" required  />
            <x-input.file name="music_id"  :model="$model" type="music" required  />
            <x-input.bool name="need_subscription"  :model="$model" required  />
        </x-form.update>
    </div>
@endsection

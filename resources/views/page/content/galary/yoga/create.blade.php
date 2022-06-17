@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">
        <x-form.create :title="$title" :action="route($route_path.'_create_save')">
            <x-input.select name="cat_id" :model="$model"
                            :ar="[null=>$model->label('null_cat')] + App\Models\Content\MainGalaryCat::where('type', 'TYPE_YOGA_TO_ME')->pluck('id', 'title')->toArray()" />
            <x-input.text name="title" :model="$model" required  />
            <x-input.text name="title_en" :model="$model" required  />
            <x-input.text name="google_drive_music" :model="$model" required  />
            <x-input.text name="google_drive_video" :model="$model" required  />
            <x-input.bool name="need_subscription"  :model="$model" required  />
        </x-form.create>
    </div>
@endsection

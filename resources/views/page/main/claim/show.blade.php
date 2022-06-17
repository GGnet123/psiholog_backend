@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <x-form.show :title="$title" :model="$model">
                <x-show.def name="from_user_id"  :model="$model" :value="$model->relFromUser ? $model->relFromUser->name : ''"   />
                <x-show.def name="user_id"  :model="$model" :value="$model->relUser ? $model->relUser->name : ''"   />
                <x-show.def name="note"  :model="$model"   />
                <x-show.file name="file_id"  :model="$model"  :value="$model->relFile"  />
                <x-show.def name="is_done"  :model="$model" :value="$model->is_done ? 'Да' : 'Нет'"   />
                <x-show.def name="answer"  :model="$model"   />

                @if (!$model->is_done)
                    <a href="{{ route($route_path.'_close', $model->id) }}" class="btn btn-sm btn-block  bg-success">@lang('main.close')</a>
                @endif
            </x-form.show>
        </div>

    </div>
@endsection


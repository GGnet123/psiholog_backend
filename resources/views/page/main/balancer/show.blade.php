@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">
        <x-form.show :title="$title" :model="$model">
            <x-show.def name="user_id"  :model="$model" :value="$model->relUser ? $model->relUser->name : null"  />
            <x-show.def name="sum"  :model="$model"   />
            <x-show.def name="type"  :model="$model" :value="$model->type_ru"   />
            <x-show.def name="is_done"  :model="$model"  :value="$model->is_done ? 'Да' : 'Нет'"  />
            <x-show.def name="is_canceled"  :model="$model"  :value="$model->is_canceled ? 'Да' : 'Нет'"  />
            <x-show.def name="is_returned"  :model="$model"  :value="$model->is_returned ? 'Да' : 'Нет'"  />

            @if ($model->is_canceled && !$model->is_returned)
                <a href="{{ route($route_path.'_returned', $model->id) }}" class="btn btn-sm btn-block  bg-success">@lang('main.return_balance')</a>
            @endif

        </x-form.show>
    </div>
@endsection


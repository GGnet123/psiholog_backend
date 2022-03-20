@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <x-form.show :title="$title" :model="$model">
                <x-show.def name="user_id"  :model="$model" :value="$model->relUser ? $model->relUser->name : ''"   />
                <x-show.def name="transaction_id"  :model="$model"    />
                <x-show.array name="last_request"  :model="$model"    />
                <x-show.array name="last_response"  :model="$model"    />
                <x-show.def name="subscription_id"  :model="$model"    />
                <x-show.def name="record_id"  :model="$model"    />
                <x-show.def name="is_done"  :model="$model" :value="$model->is_done ? 'Да' : 'Нет'"   />
                <x-show.def name="is_returned"  :model="$model" :value="$model->is_returned ? 'Да' : 'Нет'"   />
                <x-show.def name="answer"  :model="$model"   />

                @if (!$model->is_returned)
                    <a href="{{ route($route_path.'_cancel', $model->id) }}" class="btn btn-sm btn-block  bg-warning">@lang('main.return')</a>
                @endif
            </x-form.show>
        </div>

    </div>
@endsection


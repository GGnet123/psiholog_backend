@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <x-form.show :title="$title" :model="$model">
                <x-show.def name="name"  :model="$model"   />
                <x-show.def name="note"  :model="$model"   />
                <x-show.def name="from_user_id"  :model="$model" :value="$model->relFromUser ? $model->relFromUser->name : ''"   />
                <x-show.file name="file_id"  :model="$model"  :value="$model->relFile"  />
                <x-show.def name="is_closed"  :model="$model" :value="$model->is_closed ? 'Да' : 'Нет'"   />
                <x-show.def name="answer"  :model="$model"   />
            </x-form.show>

            @if (!$model->is_closed)
                <x-form.update :title="$model->label('answer_block')" :action="route($route_path.'_save', $model)">
                    <x-input.text name="answer" :model="$model" required  />
                </x-form.update>
            @endif
        </div>

    </div>
@endsection


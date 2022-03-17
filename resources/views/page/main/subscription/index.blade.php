@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">
        <form  method="get" >
            <x-form.filter >
                <div class="row">
                    <div class="col-md-3">
                        <x-input.int name="id" :model="$model" :value="$request->id" />
                    </div>

                    <div class="col-md-3">
                        <x-input.filterBool name="is_active" id="is_active" :model="$model" :value="$request->is_active"  />
                    </div>
                    <div class="col-md-6">
                        <x-input.text name="user_name" id="user_name" :model="$model" :value="$request->user_name" />
                    </div>
                </div>
            </x-form.filter>
        </form>

        <x-table.def :title="$title" >
            <table class="table table-togglable">
                <thead>
                <tr>
                    <th data-breakpoints="all">{{ $model->label('id') }}</th>
                    <th>{{ $model->label('user_id') }}</th>
                    <th>{{ $model->label('is_active') }}</th>
                    <th>{{ $model->label('date_e') }}</th>
                    <th>{{ $model->label('type_ru') }}</th>
                    <th data-breakpoints="all">{{ $model->label('created_at') }}</th>
                    <th data-breakpoints="all">{{ $model->label('updated_at') }}</th>
                    <th>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $i)
                    <tr>
                        <td>{{ $i->id }}</td>
                        <td>{{ $i->relUser ? $i->relUser->name : null }}</td>
                        <td>{{ $i->is_active ? 'Да' : 'Нет' }}</td>
                        <td>{{ $i->date_e }}</td>
                        <td>{{ $i->type_ru }}</td>
                        <td>{{ $i->created_at }}</td>
                        <td>{{ $i->updated_at }}</td>
                        <th>
                            <div class="btn-group">
                                <button type="button" class="btn  btn-primary btn-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="icon-menu7"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{ route($route_path.'_show', $i) }}">{{ __('main.show') }} </a></li>
                                </ul>
                            </div>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="panel-footer">
                <x-paginator :items="$items" :request="$request" />
            </div>
        </x-table.def>
    </div>
@endsection

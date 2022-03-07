@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">
        <form  method="get" >
            <x-form.filter >
                <div class="row">
                    <div class="col-md-4">
                        <x-input.int name="id" :model="$model" :value="$request->id" />
                    </div>

                    <div class="col-md-4">
                        <x-input.text name="name" id="name" :model="$model" :value="$request->name" />
                    </div>

                    <div class="col-md-4">
                        <x-input.text name="login" id="login" :model="$model" :value="$request->login" />
                    </div>
                </div>
            </x-form.filter>
        </form>

        <x-table.def :title="$title" >
            <table class="table table-togglable">
                <thead>
                <tr>
                    <th data-breakpoints="all">{{ $model->label('id') }}</th>
                    <th ><x-sortLink :name='$model->label("name")' attr="name" :request="$request" /></th>
                    <th ><x-sortLink :name='$model->label("login")' attr="name_en" :request="$request" /></th>
                    <th>{{ $model->label('lang') }}</th>
                    <th>{{ $model->label('is_blocked') }}</th>
                    <th>{{ $model->label('price') }}</th>
                    <th>{{ $model->label('date_b') }}</th>

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
                        <td>{{ $i->name }}</td>
                        <td>{{ $i->login }}</td>
                        <td>{{ $i->lang }}</td>
                        <td>{{ $i->is_blocked ? 'Да' : 'Нет' }}</td>
                        <td>{{ $i->price }}</td>
                        <td>{{ $i->date_b }}</td>
                        <td>{{ $i->created_at }}</td>
                        <td>{{ $i->updated_at }}</td>
                        <th>
                            <div class="btn-group">
                                <button type="button" class="btn  btn-primary btn-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="icon-menu7"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{ route($route_path.'_show', $i) }}">{{ __('main.show') }} </a></li>
                                    <li><a href="{{ route($route_path.'_block', $i) }}">{{ $i->is_blocked ? 'Разблокировать' : 'Заблокировать' }} </a></li>
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

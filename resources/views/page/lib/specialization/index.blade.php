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
                        <x-input.text name="name_en" id="name_en" :model="$model" :value="$request->name_en" />
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
                    <th ><x-sortLink :name='$model->label("name_en")' attr="name_en" :request="$request" /></th>
                    <th data-breakpoints="all">{{ $model->label('created_at') }}</th>
                    <th data-breakpoints="all">{{ $model->label('updated_at') }}</th>
                    <th>
                        <a href="{{ route($route_path.'_create') }}" class="btn btn-sm  bg-success">@lang('main.add')</a>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $i)
                    <tr>
                        <td>{{ $i->id }}</td>

                        <td>{{ $i->name }}</td>
                        <td>{{ $i->name_en }}</td>
                        <td>{{ $i->created_at }}</td>
                        <td>{{ $i->updated_at }}</td>
                        <th>
                            <div class="btn-group">
                                <button type="button" class="btn  btn-primary btn-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="icon-menu7"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{ route($route_path.'_show', $i) }}">{{ __('main.show') }} </a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{ route($route_path.'_update', $i) }}">{{ __('main.update') }} </a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{ route($route_path.'_delete', $i) }}">{{ __('main.delete') }}</a></li>
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

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
                        <x-input.text name="code" id="code" :model="$model" :value="$request->code" />
                    </div>

                    <div class="col-md-3">
                        <x-input.int name="sum" id="sum" :model="$model" :value="$request->sum" />
                    </div>

                    <div class="col-md-3">
                        <x-input.filterBool name="is_used" id="is_used" :model="$model" :value="$request->is_used" />
                    </div>

                </div>
            </x-form.filter>
        </form>

        <x-table.def :title="$title" >
            <table class="table table-togglable">
                <thead>
                <tr>
                    <th data-breakpoints="all">{{ $model->label('id') }}</th>
                    <th>{{ $model->label('code') }}</th>
                    <th><x-sortLink :name='$model->label("sum")' attr="sum" :request="$request" /></th>
                    <th><x-sortLink :name='$model->label("is_used")' attr="is_used" :request="$request" /></th>
                    <th data-breakpoints="all">{{ $model->label('created_at') }}</th>
                    <th data-breakpoints="all">{{ $model->label('updated_at') }}</th>
                    <th></th>
                    <th>
                        <a href="{{route($route_path.'_create')}}" class="btn btn-sm  bg-success">@lang('main.add')</a>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $i)
                    <tr>
                        <td>{{ $i->id }}</td>
                        <td>{{ $i->code }}</td>
                        <td>{{ $i->sum }}</td>
                        <td>{{ $i->is_used ? 'Да' : 'Нет' }}</td>
                        <td>{{ $i->created_at }}</td>
                        <td>{{ $i->updated_at }}</td>
                        <th>
                            <div class="btn-group">
                                <button type="button" class="btn  btn-primary btn-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="icon-menu7"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{ route($route_path.'_delete', $i) }}">{{ __('main.delete') }} </a></li>
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

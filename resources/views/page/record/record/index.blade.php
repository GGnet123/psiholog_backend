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
                        <x-input.select name="status_id" id="status_id" :model="$model" :value="$request->status_id" :ar="[null=>null] + $model->ar_status_ru" />
                    </div>

                    <div class="col-md-4">
                        <x-input.date name="record_date" id="record_date" :model="$model" :value="$request->record_date"  />
                    </div>

                    <div class="col-md-6">
                        <x-input.text name="doctor_name" id="doctor_name" :model="$model" :value="$request->doctor_name" />
                    </div>

                    <div class="col-md-6">
                        <x-input.text name="customer_name" id="customer_name" :model="$model" :value="$request->customer_name" />
                    </div>

                </div>
            </x-form.filter>
        </form>

        <x-table.def :title="$title" >
            <table class="table table-togglable">
                <thead>
                <tr>
                    <th data-breakpoints="all">{{ $model->label('id') }}</th>
                    <th>{{ $model->label('doctor_id') }}</th>
                    <th>{{ $model->label('customer_id') }}</th>
                    <th>{{ $model->label('record_str') }}</th>
                    <th>{{ $model->label('status_id') }}</th>
                    <th>{{ $model->label('is_canceled') }}</th>
                    <th>{{ $model->label('is_moved') }}</th>
                    <th>{{ $model->label('sum') }}</th>
                    <th>{{ $model->label('has_coupon') }}</th>
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
                        <td>{{ $i->relDoctor ? $i->relDoctor->name : null }}</td>
                        <td>{{ $i->relCustomer ? $i->relCustomer->name : null }}</td>
                        <td>{{ $i->record_str }}</td>
                        <td>{{ $i->status_ru }}</td>
                        <td>{{ $i->is_canceled ? 'Да' : 'Нет' }}</td>
                        <td>{{ $i->is_moved ? 'Да' : 'Нет' }}</td>
                        <td>{{ $i->sum }}</td>
                        <td>{{ $i->coupon_id ? 'Да ('.$i->relCoupon->sum.')' : 'Нет' }}</td>
                        <td>{{ $i->created_at }}</td>
                        <td>{{ $i->updated_at }}</td>
                        <th>
                            <div class="btn-group">
                                <button type="button" class="btn  btn-primary btn-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="icon-menu7"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{ route($route_path.'_show', $i) }}">{{ __('main.show') }} </a></li>
                                    @if(in_array($i->status_id, [
                                                                    \App\Models\Record\RecordDoctor::CREATED_STATUS,
                                                                    \App\Models\Record\RecordDoctor::APPROVED_STATUS,
                                                                    \App\Models\Record\RecordDoctor::ON_WORK_STATUS,
                                                                ]) )
                                        <li><a href="{{ route($route_path.'_cancel', $i) }}">{{ __('main.cancel') }} </a></li>
                                    @endif
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

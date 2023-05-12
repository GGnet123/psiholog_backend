@extends('layout')

@section('title', $title)

@section('content')
    <div class="row">
        <div class="col-md-8">
            <x-form.update :action="route($route_path.'_update', $model)" :title="$title" :model="$model">
                <x-input.text name="name"  :model="$model"   />
                <x-input.text name="login"  :model="$model"   />
                <x-input.text name="lang"  :model="$model"   />
                <x-input.text name="doctor_credit_card"  :model="$model"   />

                <x-input.file name="avatar_id"  :model="$model"  :value="$model->relAvatar"  />
                <x-input.int name="price"  :model="$model"   />
                <x-input.date name="date_b"  :model="$model" :value="date('Y-m-d', strtotime($model->date_b))" />
                <x-input.textarea name="card_data"  :model="$model"   />
                <x-input.multiSelect name="specializations[]"  :model="$model"
                :dataar="[null=>'<Выберите из списка>'] + App\Models\Main\LibSpecialization::all()->pluck('name', 'id')->toArray()"
                :value="array_keys($specializations)" />
                <x-input.text name="education"  :model="$model"   />
                <x-input.text name="therapy_methods"  :model="$model"   />
            </x-form.update>


            <!-- <x-form.panel title="Видео" >
                <div class="row">
                    @foreach($videos as $v)
                        <div class="col-md-6">
                            <video width="100%" height="300" controls="controls" poster="video/duel.jpg">
                                <source src="/{{ $v->path  }}" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
                                Тег video не поддерживается вашим браузером.
                                <a href="/{{ $v->path  }}">Скачайте видео</a>.
                            </video>
                        </div>
                    @endforeach

                </div>
            </x-form.panel> -->
        </div>
        <div class="col-md-4">
            @if ($timetable)
            <x-form.panel title="Расписание" >
                <div class="form-group">
                    <label>Дни недели</label> <br/>
                    @for($i = 1; $i <=7; $i++)
                        <span class="label {{  $timetable->{'day_0'.$i} ? 'label-default' : 'label-success'}}">{{ __('main.day'.$i) }}</span>
                        @if ($i != 7)
                            |
                        @endif
                    @endfor
                </div>

                <div class="form-group">
                    <label>Ночное время</label> <br/>
                    @for($i = 0; $i <= 7; $i++)
                        @php
                            $i_str = str_pad($i, 2, '0', STR_PAD_LEFT);
                        @endphp
                        <span class="label {{  $timetable->{'hour_'.$i_str} ? 'label-default' : 'label-success'}}">{{ $i_str.':00' }}</span>
                        @if ($i != 7)
                            |
                        @endif
                    @endfor
                </div>
                <div class="form-group">
                    <label>Утреннее время</label> <br/>
                    @for($i = 8; $i <= 11; $i++)
                        @php
                            $i_str = str_pad($i, 2, '0', STR_PAD_LEFT);
                        @endphp
                        <span class="label {{  $timetable->{'hour_'.$i_str} ? 'label-default' : 'label-success'}}">{{ $i_str.':00' }}</span>
                        @if ($i != 11)
                            |
                        @endif
                    @endfor
                </div>
                <div class="form-group">
                    <label>Дневное время</label> <br/>
                    @for($i = 12; $i <= 18; $i++)
                        @php
                            $i_str = str_pad($i, 2, '0', STR_PAD_LEFT);
                        @endphp
                        <span class="label {{  $timetable->{'hour_'.$i_str} ? 'label-default' : 'label-success'}}">{{ $i_str.':00' }}</span>
                        @if ($i != 18)
                            |
                        @endif
                    @endfor
                </div>
                <div class="form-group">
                    <label>Вечернее время</label> <br/>
                    @for($i = 19; $i <= 23; $i++)
                        @php
                            $i_str = str_pad($i, 2, '0', STR_PAD_LEFT);
                        @endphp
                        <span class="label {{  $timetable->{'hour_'.$i_str} ? 'label-default' : 'label-success'}}">{{ $i_str.':00' }}</span>
                        @if ($i != 23)
                            |
                        @endif
                    @endfor
                </div>
            </x-form.panel>
            @endif
            <x-form.panel title="Сертификаты" >
                <div class="row">
                    @foreach($certificats as $c)
                        <div class="col-md-6">
                            <div class="thumbnail">
                                <a href="/{{ $c->path  }}" target="_blank">
                                    <img src="/{{ $c->path  }}" alt="">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-form.panel>
        </div>

    </div>
@endsection

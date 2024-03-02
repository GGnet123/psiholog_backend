@extends('layout')

@section('title', $title)

@section('content')

    <style>
        .timetable_el {
            cursor: pointer;
        }
        #upload-document-btn {
            margin-left: 10px;
        }
        .delete-cert {
            cursor: pointer;
            margin-left: 5px;
            color: red;
            font-weight: bold;
        }
    </style>
    <div class="row" id="main-row" data-doctor-id="{{$model->id}}">
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
                <x-input.multiSelect name="specializations[]" required  :model="$model"
                :dataar="[null=>'<Выберите из списка>'] + App\Models\Main\LibSpecialization::all()->pluck('name', 'id')->toArray()"
                :value="array_keys($specializations)" />
                <x-input.textarea name="education"  :model="$model"   />
                <x-input.textarea name="therapy_methods"  :model="$model"   />
                <x-input.int name="experience"  :model="$model"   />
            </x-form.update>


            <!-- <x-form.panel title="Видео" >
                <div class="row">
{{--                    @foreach($videos as $v)--}}
                        <div class="col-md-6">
                            <video width="100%" height="300" controls="controls" poster="video/duel.jpg">
{{--                                <source src="/{{ $v->path  }}" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>--}}
                                Тег video не поддерживается вашим браузером.
{{--                                <a href="/{{ $v->path  }}">Скачайте видео</a>.--}}
                            </video>
                        </div>
{{--                    @endforeach--}}

                </div>
            </x-form.panel> -->
        </div>
        <div class="col-md-4">
            @if ($timetable)
            <x-form.panel title="Расписание" >
                <div class="form-group">
                    <label>Дни недели</label> <br/>
                    @for($i = 1; $i <=7; $i++)
                        <span data-time="{{ 'day_0'.$i }}" class="timetable_el label {{  $timetable->{'day_0'.$i} ? 'label-default' : 'label-success'}}">{{ __('main.day'.$i) }}</span>
                    @endfor
                </div>

                <div class="form-group">
                    <label>Ночное время</label> <br/>
                    @for($i = 0; $i <= 7; $i++)
                        @php
                            $i_str = str_pad($i, 2, '0', STR_PAD_LEFT);
                        @endphp
                        <span data-time="{{ 'hour_'.$i_str }}" class="timetable_el label {{  $timetable->{'hour_'.$i_str} ? 'label-default' : 'label-success'}}">{{ $i_str.':00' }}</span>
                    @endfor
                </div>
                <div class="form-group">
                    <label>Утреннее время</label> <br/>
                    @for($i = 8; $i <= 11; $i++)
                        @php
                            $i_str = str_pad($i, 2, '0', STR_PAD_LEFT);
                        @endphp
                        <span data-time="{{ 'hour_'.$i_str }}" class="timetable_el label {{  $timetable->{'hour_'.$i_str} ? 'label-default' : 'label-success'}}">{{ $i_str.':00' }}</span>
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
                        <span data-time="{{ 'hour_'.$i_str }}" class="timetable_el label {{  $timetable->{'hour_'.$i_str} ? 'label-default' : 'label-success'}}">{{ $i_str.':00' }}</span>

                    @endfor
                </div>
                <div class="form-group">
                    <label>Вечернее время</label> <br/>
                    @for($i = 19; $i <= 23; $i++)
                        @php
                            $i_str = str_pad($i, 2, '0', STR_PAD_LEFT);
                        @endphp
                        <span data-time="{{ 'hour_'.$i_str }}" class="timetable_el label {{  $timetable->{'hour_'.$i_str} ? 'label-default' : 'label-success'}}">{{ $i_str.':00' }}</span>

                    @endfor
                </div>
            </x-form.panel>
            @endif
{{--            <x-form.panel title="Сертификаты" >--}}
{{--                <div class="row" id="uploaded-certs">--}}
{{--                    @foreach($certificats as $c)--}}
{{--                        @if(!in_array($c->extension, ['png', 'jpg', 'jpeg']))--}}
{{--                            <div class="col-md-8">--}}
{{--                                <a href="/{{ $c->path  }}" target="_blank">--}}
{{--                                    {{$c->title}}--}}
{{--                                </a>--}}
{{--                                <span class="delete-cert" data-cert="{{$c->id}}">X</span>--}}
{{--                            </div>--}}
{{--                        @else--}}
{{--                            <div class="col-md-8">--}}
{{--                                <a href="/{{ $c->path  }}" target="_blank">--}}
{{--                                    <img src="/{{ $c->path  }}" style="height: 100px;width: 100px" alt="">--}}
{{--                                </a>--}}
{{--                                <span class="delete-cert" data-cert="{{$c->id}}">X</span>--}}
{{--                            </div>--}}
{{--                        @endif--}}

{{--                    @endforeach--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div style="display: flex; align-items: center;">--}}
{{--                        <input class="input" type="file" multiple id="upload-certificate-input">--}}
{{--                        <button class="btn btn-success" id="upload-certificate-btn">Загрузить</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </x-form.panel>--}}

            <x-form.panel title="Договор" >
                @if($model->document_id)
                    <div class="row">
                        <div class="col-md-6">
                            <a href="/{{ $model->relDocument->path  }}" target="_blank">
                                {{$model->relDocument->title}}
                            </a>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div>
                        <div style="display: flex; align-items: center;">
                            <input class="input" type="file" accept=".doc,.docx,.pdf" id="upload-document-input">
                            <button class="btn btn-success" id="upload-document-btn">Загрузить</button>
                        </div>
                    </div>
                </div>
            </x-form.panel>
        </div>

    </div>

    <script>
        $(function () {
            let doctor_id = $('#main-row').attr('data-doctor-id')
            $('.timetable_el').click(function () {
                let col = $(this).attr('data-time')
                $.post('/admin/main/doctor/set-timetable-time', {col: col, doctor_id: doctor_id}, function (data) {
                    if (data) {
                        let $el = $('span.timetable_el[data-time="'+col+'"]')
                        $el.removeClass(data.value ? 'label-default' : 'label-success')
                        $el.addClass(data.value ? 'label-success' : 'label-default')
                    }
                })
            })

            $('body').on('click', '.delete-cert', function () {
                let $that = $(this)
                let certId = $(this).attr('data-cert')
                $.post('/admin/main/doctor/delete-certificate', {cert_id: certId}, function () {
                    $that.parent().remove()
                })
            })

            $('#upload-certificate-btn').click(function () {
                var fd = new FormData();

                var files = $('#upload-certificate-input')[0].files;
                if (files.length > 0) {
                    $.each(files, function (i, file) {
                        fd.append('file[]', file)
                    })
                    fd.append('user_id', doctor_id)
                    $.ajax({
                        url:'/admin/main/doctor/upload-certificates',
                        type:'post',
                        data:fd,
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        success:function(response){
                            alert('Файлы успешно загружены')
                            $.each(response, function (i, data) {
                                if(['png', 'jpg','jpeg'].includes(data.extension)) {
                                    $('#uploaded-certs').prepend('<div class="col-md-8"> ' +
                                        '<a href="/'+data.path+'" target="_blank"> ' +
                                        '<img src="/'+data.path+'" style="height: 100px;width: 100px" alt=""> ' +
                                        '</a> ' +
                                        '<span class="delete-cert" data-cert="'+data.file_id+'">X</span> ' +
                                        '</div>')
                                } else {
                                    $('#uploaded-certs').prepend('<div class="col-md-8"> ' +
                                        '<a href="/'+data.path+'" target="_blank">' +
                                        data.title +
                                        '</a> ' +
                                        '<span class="delete-cert" data-cert="'+data.file_id+'">X</span> ' +
                                        '</div>')
                                }

                            })

                        },
                        fail: function () {
                            alert('Ошибка! Возможно файл/файлы слишком много весят')
                        }
                    });
                }
            })

            $('#upload-document-btn').click(function () {
                var fd = new FormData();

                var files = $('#upload-document-input')[0].files;
                if (files.length > 0) {
                    fd.append('file',files[0]);
                    fd.append('user_id', doctor_id)
                    $.ajax({
                        url:'/admin/main/doctor/upload-document',
                        type:'post',
                        data:fd,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success:function(response){
                            alert('Файл успешно загружен')
                        }
                    });
                }
            })
        })
    </script>
@endsection

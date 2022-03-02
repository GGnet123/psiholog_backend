@if (isset($model))
    @php
        $var = 'uploaded_file_'.rand(1000, 9999);
    @endphp
    <div class="form-group">
        <input-label :model="$model" :name="$name" :disabled="(!isset($disabled) ? 0 : 1)" :required="(!isset($required) ? 0 : 1)"  :fileLink="$model->{$name}" />
        <input type="file"  id="{{ isset($id) ? $id : '' }}"
                class="form-control {{ isset($class) ? $class  : ''}}"
               {{ isset($disabled) ? 'disabled' : '' }}
               data-file_max='2'  >
        <span class="help-inline ">{!! tr('main.max_filesize')  !!}</span>
        <br />
        <div class="{{ $var  }} uploaded_file_block">
            @if (isset($value) && is_array($value) && count($value) > 0)
                @foreach($value as $f)
                    <span class="link_block">
                        Файла загружен <a href="{{ fileLink($f) }}" target="_blank" class="link_href">{{ fileLink($f) }}</a> |
                        <input type="hidden" name="{{ $name }}[]" value="{{ $f }}">
                        <a target="_blank" class="link_delete">Удалить</a>
                        <br/>
                    </span>
                @endforeach
            @endif
        </div>

    </div>
@else
    <p>{{ tr('main.non_param_input')  }}</p>
@endif



@section('js_block')
    @parent

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $( ".{{ $var  }}" ).on( "click", ".link_delete", function() {
                $(this).parent().remove();
            });

            $('#{{ $id }}').change(function(){
                var fd = new FormData();
                var files = $('#{{ $id }}')[0].files;

                if ($('.{{ $var  }} .link_block').length >= 10){
                    $('#{{ $id }}').val(null);
                    alert('Нельзя больше 10 файлов');
                    return;
                }


                if (files.length > 0) {
                    fd.append('upload_file', files[0]);

                    $.ajax({
                        url: '{{ route('admin_ajax_file') }}',
                        data: fd,
                        processData: false,
                        contentType: false,
                        type: 'POST',
                        success: function(data) {
                            console.log(data);
                            if (data.success == true) {
                                $('.{{ $var  }}').append(`
                                     <span class="link_block">
                                        Файла загружен <a href="` + data.url + `" target="_blank" class="link_href">` + data.url + `</a> |
                                        <input type="hidden" name="{{ $name }}[]" value="` + data.clear_url + `">
                                        <a target="_blank" class="link_delete">Удалить</a>
                                        <br/>
                                    </span>
                                `);

                                $('#{{ $id }}').val(null);
                            }
                        }
                    });
                }
            })



        });
    </script>
@endsection
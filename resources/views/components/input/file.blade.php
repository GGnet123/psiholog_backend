@if (isset($model))
    @php
        $id = rand(1000, 9999);
        $type_id = \App\Models\Services\UploaderFile::IMAGE;
        if (isset($type) && $type == 'video')
            $type_id = \App\Models\Services\UploaderFile::VIDEO;
        if (isset($type) && $type == 'music')
            $type_id = \App\Models\Services\UploaderFile::MUSIC;
    @endphp
    <div class="form-group">
        <x-input.label :model="$model" :name="$name" :disabled="(!isset($disabled) ? 0 : 1)" :required="(!isset($required) ? 0 : 1)"   />

        <input type="file"  id="{{ $id }}_file" class="form-control {{ isset($class) ? $class  : ''}}"
        {{ isset($required) && !$model->{$name} ? 'required' : '' }}  data-file_max='11' >

        <input type="hidden" name="{{ $name }}" id="{{ $id }}_value" >
    </div>
@else
    <p>{{ tr('main.non_param_input')  }}</p>
@endif


@section('js_block')
    @parent
    <script >
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on("change", "#{{ $id }}_file", function() {
            console.log('changed');

            var file_data = $("#{{ $id }}_file").prop("files")[0];
            var form_data = new FormData();
            form_data.append("upload_file", file_data);
            form_data.append("type_id", {{ $type_id  }});


            jQuery.ajax({
                type: 'POST',
                url: "{{ route('admin_save_file')  }}",
                cache: false,
                contentType: false,
                processData: false,
                async: false,
                data: form_data,
                success: function(returnval) {
                    console.log("asdasd");
                    jQuery("#{{ $id }}_value" ).val(returnval.id);
                    console.log(returnval.id, $("#{{ $id }}_value" ).val());
                }
            });
        });



    </script>
@endsection

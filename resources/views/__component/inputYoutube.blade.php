@if (isset($model))
    @php  
        if (!isset($id))
            $id = rand(100, 999).'_yotube';
    @endphp
    <div class="form-group">
        <input-label :model="$model" :name="$name" :disabled="(!isset($disabled) ? 0 : 1)" :required="(!isset($required) ? 0 : 1)"   />

        <input type="text" 
                
                @if (isset($group))
                    name="{{ $group }}[{{ $name }}]" 
                @else 
                    name="{{ $name }}" 
                @endif 
                    
                value="{{ isset($value) ? $value : $model->{$name} }}" 

                id="{{ isset($id) ? $id : '' }}" class="form-control {{ isset($class) ? $class  : ''}}" 
                {{ isset($disabled) ? 'disabled' : '' }} 
                {{ isset($required) ? 'required' : '' }} 
                {!! isset($extra) ? $extra: '' !!} {!! isset($checkval) ? 'data-exist_url="'.$checkval.'"': '' !!}>

        <iframe width="100%" height="400" src="https://www.youtube.com/embed/tgbNymZ7vqY" id="{{ isset($id) ? $id : '' }}_frame"></iframe>
    </div>
@else 
    <p>{{ tr('main.non_param_input')  }}</p>
@endif



@section('js_block')
	@parent
    <script >
    
        $(document).ready(function () {
            function youtube_parser(url){
                var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
                var match = url.match(regExp);
                return (match&&match[7].length==11)? match[7] : false;
            }

            $('#{{ $id }}').change(function(){
                let video_key = youtube_parser($(this).val());
                showYoutube(video_key);
            });

            let video_key = $('#{{ $id }}').val();
            showYoutube(video_key);

            function showYoutube(video_key){
                if (!video_key || video_key == ''){
                    $('#{{ $id }}_frame').hide();
                    return;
                }
                
                $('#{{ $id }}_frame').show();
                $('#{{ $id }}_frame').attr('src', 'https://www.youtube.com/embed/'+video_key);

                $('#{{ $id }}').val(video_key);
            }
        });
    </script>
@endsection

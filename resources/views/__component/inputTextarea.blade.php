@if (isset($model))
    <div class="form-group spec_teat_area">
        <input-label :model="$model" :name="$name" :disabled="(!isset($disabled) ? 0 : 1)" :required="(!isset($required) ? 0 : 1)"   />
        
        
            <textarea 
                @if (isset($group))
                    name="{{ $group }}[{{ $name }}]" 
                @else 
                    name="{{ $name }}" 
                @endif
                 id="{{ isset($id) ? $id : '' }}" 
                class="wysihtml5 summernote wysihtml5-default form-control {{ isset($class) ? $class  : ''}}" 
                {{ isset($required) ? 'required' : '' }}  {{ isset($disabled) ? 'disabled' : '' }} 
                {!! isset($extra) ? $extra: '' !!}    rows="24" cols="4">{!! isset($value) ? $value : $model->{$name} !!}</textarea>

    
      
    </div>
@else 
    <p>{{ tr('main.non_param_input')  }}</p>
@endif

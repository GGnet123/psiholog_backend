@if (isset($model))
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
    </div>
@else 
    <p>{{ tr('main.non_param_input')  }}</p>
@endif
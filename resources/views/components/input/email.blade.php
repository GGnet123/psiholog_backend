@if (isset($model))
    <div class="form-group">
        <x-input.label :model="$model" :name="$name" :disabled="(!isset($disabled) ? 0 : 1)" :required="(!isset($required) ? 0 : 1)"   />
        
        <input type="email" 
                @if (isset($group))
                    name="{{ $group }}[{{ $name }}]" 
                @else 
                    name="{{ $name }}" 
                @endif
                
                 id="{{ isset($id) ? $id : '' }}" class="form-control {{ isset($class) ? $class  : ''}}" 
                value="{{ isset($value) ? $value : $model->{$name} }}"
                {{ isset($required) ? 'required' : '' }} {{ isset($disabled) ? 'disabled' : '' }} 
                 {!! isset($extra) ? $extra: '' !!} {!! isset($checkval) ? 'data-exist_url="'.$checkval.'"': '' !!}>
    </div>
@else 
    <p>{{ __('main.non_param_input')  }}</p>
@endif

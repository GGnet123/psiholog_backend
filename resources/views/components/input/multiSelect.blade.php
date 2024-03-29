@if (isset($model))
    <div class="form-group">
        <x-input.label :model="$model" :name="$name" :disabled="(!isset($disabled) ? 0 : 1)" :required="(!isset($required) ? 0 : 1)"   />
        
        <select name="{{ $name }}" id="{{ isset($id) ? $id : '' }}" class="form-control select2 {{ isset($class) ? $class  : ''}}"  {{ isset($disabled) ? 'disabled' : '' }}  multiple
                {{ isset($required) ? 'required' : '' }}>
            @foreach ($dataar as $k => $v)
                <option value="{{ $k }}" {{ (is_array($value) && in_array($k, $value)) || ($model->{$name} == $k && !isset($value)) ? 'selected' : '' }}>{{ $v }}</option>
            @endforeach
        </select>
    </div>
@else 
    <p>{{ __('main.non_param_input')  }}</p>
@endif

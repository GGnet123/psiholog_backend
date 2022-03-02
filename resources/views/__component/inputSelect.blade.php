@if (isset($model))
    <div class="form-group">
        <input-label :model="$model" :name="$name" :disabled="(!isset($disabled) ? 0 : 1)" :required="(!isset($required) ? 0 : 1)"   />
        
        <select name="{{ $name }}" id="{{ isset($id) ? $id : '' }}" class="form-control select2 {{ isset($class) ? $class  : ''}}"  {{ isset($disabled) ? 'disabled' : '' }} 
                {{ isset($required) ? 'required' : '' }}>
            @foreach ($ar as $k => $v)
                <option value="{{ $k }}" {{ (isset($value) && $value == $k) || ($model->{$name} == $k && !isset($value)) ? 'selected' : '' }}>{{ $v }}</option>
            @endforeach
        </select>
    </div>
@else 
    <p>{{ tr('main.non_param_input')  }}</p>
@endif

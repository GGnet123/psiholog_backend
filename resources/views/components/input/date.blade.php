@if (isset($model))
    <div class="form-group">
        <x-input.label :model="$model" :name="$name" :disabled="(!isset($disabled) ? 0 : 1)" :required="(!isset($required) ? 0 : 1)"   />
        
        <input type="date" name="{{ $name }}" id="{{ isset($id) ? $id : '' }}"  max='9999-12-31' min='1000-01-01'
            class="form-control {{ isset($class) ? $class  : ''}}" 
            value="{{ isset($value) ? $value : $model->{$name} }}"
            {!! isset($extra) ? $extra: '' !!} {{ isset($required) ? 'required' : '' }}  {{ isset($disabled) ? 'disabled' : '' }} 
            {!! isset($checkval) ? 'data-exist_url="'.$checkval.'"': '' !!}>
    </div>
@else 
    <p>{{ __('main.non_param_input')  }}</p>
@endif

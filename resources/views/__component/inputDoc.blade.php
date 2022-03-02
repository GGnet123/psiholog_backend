@if (isset($model))
    <div class="form-group">
        <input-label :model="$model" :name="$name" :disabled="(!isset($disabled) ? 0 : 1)" :required="(!isset($required) ? 0 : 1)"  :fileLink="$model->{$name}" />
        
        <input type="file" name="{{ $name }}" id="{{ isset($id) ? $id : '' }}" class="form-control {{ isset($class) ? $class  : ''}}"  {{ isset($disabled) ? 'disabled' : '' }} 
                {{ isset($required) && !$model->{$name} ? 'required' : '' }} {!! isset($extra) ? $extra: '' !!} data-file_max='10'
               >
        <span class="help-inline ">Размер документа не должен быть более 10МБ.</span>
    </div>
@else 
    <p>{{ tr('main.non_param_input')  }}</p>
@endif

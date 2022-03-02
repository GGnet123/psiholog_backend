@if (isset($model))
    @php 
        $bool_val = (isset($value) ? $value : $model->{$name});
    @endphp
    <div class="form-group"
         id="$id">
        <x-input.label :model="$model" :name="$name"   :disabled="(!isset($disabled) ? 0 : 1)" :required="(!isset($required) ? 0 : 1)"  />

        <label class="radio-inline">
            <input type="radio" 
                @if (isset($group))
                    name="{{ $group }}[{{ $name }}]" 
                @else 
                    name="{{ $name }}" 
                @endif
                {{ !$bool_val ? 'checked' : '' }} value='0' {{ isset($required) ? 'required' : '' }} {{ isset($disabled) ? 'disabled' : '' }} >
            {{ __('main.no') }}
        </label>

        <label class="radio-inline">
            <input type="radio"
                @if (isset($group))
                    name="{{ $group }}[{{ $name }}]" 
                @else 
                    name="{{ $name }}" 
                @endif  
                {{ $bool_val ? 'checked' : '' }} value='1' {{ isset($required) ? 'required' : '' }} {{ isset($disabled) ? 'disabled' : '' }} >
            {{ __('main.yes')  }}
        </label>
    </div>
@else 
    <p>{{ __('main.non_param_input')  }}</p>
@endif

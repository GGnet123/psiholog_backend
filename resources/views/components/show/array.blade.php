@if (isset($model))
    @php
        $val = (isset($value) ? $value : $model->{$name});
    @endphp

    @if ($val || $val === 0)
        <div class="form-group">
            <label>
                {{ $model->label($name) }}
            </label>

            <pre class="p_5 pre_show_modal">{!! json_encode($val) !!}</pre>
        </div>
    @endif
@else
    <p>{{ __('main.non_param_input')  }}</p>
@endif

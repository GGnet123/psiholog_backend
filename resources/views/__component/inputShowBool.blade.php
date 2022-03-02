@if (isset($model))
    @php
        $val = (isset($value) ? $value : $model->{$name});
    @endphp

        <div class="form-group">
            <label>
                {{ $model->getLabel($name) }}
            </label>

            <pre class="p_5 pre_show_modal">{{ $val ? 'Да' : 'Нет' }}</pre>
        </div>
@else
    <p>{{ tr('main.non_param_input')  }}</p>
@endif

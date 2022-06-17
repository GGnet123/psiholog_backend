@if (isset($model))
    @php
        $val = (isset($value) ? $value : $model->{$name});
    @endphp

    @if ($val)
        <div class="form-group">
            <label>
                {{ $model->label($name) }}
            </label>

            <pre class="p_5 pre_show_modal"><a href="/{!! $val->path !!}" target="_blank">Просмотреть</a></pre>
        </div>
    @endif
@else
    <p>{{ __('main.non_param_input')  }}</p>
@endif

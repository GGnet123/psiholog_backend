@if (isset($model))
    @php
        $val = (isset($value) ? $value : $model->{$name});
    @endphp

    @if ($val)
        <div class="form-group">
            <label>
                {{ $model->getLabel($name) }}
            </label>

            <div class="p_5 pre_show_modal" style="    display: block;
                                                    padding: 9.5px;
                                                    margin: 0 0 10px;
                                                    font-size: 12px;
                                                    line-height: 1.5384616;
                                                    word-break: break-all;
                                                    word-wrap: break-word;
                                                    color: #333333;
                                                    background-color: #fcfcfc;
                                                    border: 1px solid #ddd;
                                                    border-radius: 3px;">{!! $val !!}</div>
        </div>
    @endif
@else
    <p>{{ tr('main.non_param_input')  }}</p>
@endif

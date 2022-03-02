@if (isset($model))
    <div class="form-group">
        <label>
            {{ $model->getLabel($name) }}
        </label>

        <pre class="p_5 pre_show_modal">@if ($model->{$name}) загружено <a href="{{ fileLink($model->{$name}) }}" target="_blank">просмотреть</a>@else не загружено @endif</pre>
    </div>
@else 
    <p>{{ tr('main.non_param_input')  }}</p>
@endif

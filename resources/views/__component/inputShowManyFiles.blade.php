@if (isset($model))
    <div class="form-group">
        <label>
            {{ $model->getLabel($name) }}
        </label>

        <pre class="p_5 pre_show_modal"> @if (isset($value) && is_array($value) && count($value))
Загруженные файлы: @foreach($value as $f) <a href="{{ fileLink($f) }}" target="_blank">{{ tr('main.show_file_link')  }}</a>, @endforeach @endif </pre>
    </div>
@else
    <p>{{ tr('main.non_param_input')  }}</p>
@endif

 <label class="display-block ">
    {{ $model->label($name) }}
    @if ($required)
        <span class="text-danger">*</span>
    @endif

    @if (isset($fileLink) && $fileLink)
        ({{ __('main.alray_uploaded')  }} <a href="{{ fileLink($model->{$name}) }}" target="_blank">{{ __('main.show_file_link')  }}</a>)
    @endif
</label>
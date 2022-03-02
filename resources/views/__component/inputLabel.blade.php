 <label class="display-block ">
    @if (!$disabled && $tooltip = Modules\Core\Services\TooltipGenerator::get($model->getTable(), $model->getLabel($name)))
        <i class="icon-help" data-popup="popover" data-trigger="hover" data-content='{{ $tooltip }}'></i>
    @endif
    {{ $model->getLabel($name) }}
    @if ($required)
        <span class="text-danger">*</span>
    @endif

    @if (isset($fileLink) && $fileLink)
        ({{ tr('main.alray_uploaded')  }} <a href="{{ fileLink($model->{$name}) }}" target="_blank">{{ tr('main.show_file_link')  }}</a>)
    @endif
</label>
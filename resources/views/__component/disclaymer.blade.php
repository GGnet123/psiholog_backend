
@if ($disclaymer = Modules\Core\Services\DisklaimerGenerator::get($model->getTable(), $type))
    <div class="col-md-12">
        <div class="alert alert-info alert-styled-left alert-bordered">
            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">{{ tr('main.close') }}</span></button>
            {!! $disclaymer !!}
        </div>
    </div>
@endif
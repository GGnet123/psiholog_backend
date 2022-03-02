<div class="col-md-12">
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title">{{ $title }}</h5>
        </div>
        <div class="panel-body">
            <form action="{{ $action }}" method="post" enctype="multipart/form-data" class="need_validate_form " novalidate>
                {!! $slot !!}


                <button type="submit" class="btn bg-brown pull-right" >{{ __('main.button_save') }}</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </div>
    </div>
</div>

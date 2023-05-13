<div class="panel panel-flat">
    <div class="panel-heading">
        <h6 class="panel-title">{{ $title }}</h6>
    </div>
    <div class="row text-center">
        @foreach($counters as $c)
            <div class="col-md-{{ $c['col'] }}">
                <div class="content-group">
                    <h6 class="text-semibold no-margin">{{ $c['val'] }}</h6>
                    <span class="text-muted text-size-small">{{ $c['name'] }}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>

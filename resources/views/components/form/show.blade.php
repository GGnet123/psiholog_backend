<div class="col-md-12">
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title">{{ $title }}</h5>
        </div>
        <div class="panel-body">

            {!! $slot !!}

            <hr />
            <x-show.def name="created_at" :model="$model"  />
            <x-show.def name="updated_at" :model="$model"  />
        </div>
    </div>
</div>

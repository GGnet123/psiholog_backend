  <div class="col-md-12">
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title">{{ $title }}</h5>
        </div>
        <div class="panel-body">
            
            {!! $form !!} 
                
            <show-detail-block :model="$model" />  
        </div>
    </div>
</div>
         
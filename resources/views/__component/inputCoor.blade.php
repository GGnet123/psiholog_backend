<div class="row">
    <div class="col-md-12">
        <div id='map' style="width: 100%; height: 300px;" ></div>
    </div>
    <input type="hidden" name="{{ $name }}" value="{{ $model->{$name} }}" id="data_coor">
</div>  



@section('js_block')
	@parent
    <script type="text/javascript" src="//api-maps.yandex.ru/2.1/?lang=ru-RU" ></script>
	
    <script >
    

        $(document).ready(function () {

            var myMap;
            ymaps.ready(init);
            var ar_coor = [];

            function init()
            {

                try {
                    ar_coor = JSON.parse($('#data_coor').val());
                } catch (err) {
                    ar_coor = [];
                }


                myMap = new ymaps.Map("map",{
                    center: [51.14345176, 71.44592914],
                    zoom: 3,
                    behaviors: ["default", "scrollZoom"]
                },
                {
                    balloonMaxWidth: 300
                });

                
                
                myPlacemark = new ymaps.Placemark(ar_coor);
                myMap.geoObjects.add(myPlacemark);

               


                myMap.events.add("click", function(e){
                    var coords = e.get("coords");
                    
                    ar_coor = [coords[0].toPrecision(10), coords[1].toPrecision(10)];
                    
                    myMap.geoObjects.removeAll();

                    myPlacemark = new ymaps.Placemark(ar_coor);
                    myMap.geoObjects.add(myPlacemark);

                    $('#data_coor').val(JSON.stringify(ar_coor));
                });

            }
        });
    </script>
@endsection

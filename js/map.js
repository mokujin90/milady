var mapJs ={
    currentMap:null,
    markersCluster:null,
    selectorLat:'#coords-lat',
    selectorLon:'#coords-lon',
    init:function(params){
        mapJs.selectorLat = params.selectorLat;
        mapJs.selectorLon = params.selectorLon;
        L.Icon.Default.imagePath = '/js/vendor/images'; //нужно для ajax-вызова нормального
        var mapSetting = {};
        if(params.cluster){
            mapJs.markersCluster = new L.MarkerClusterGroup();
        }
        mapJs.currentMap = L.map(params.id,mapSetting).setView([params.lat,params.lon ], params.zoom);
        mapJs.currentMap.scrollWheelZoom.disable();
        L.tileLayer('https://{s}.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6IlhHVkZmaW8ifQ.hAMX5hSW-QnTeRCMAy9A8Q', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="http://mapbox.com">Mapbox</a>',
            id: 'mapbox.streets'
        }).addTo(mapJs.currentMap);
        //добавим поиск
        if(params.draggable==true && params.search == true){
            new L.Control.GeoSearch({
                provider: new L.GeoSearch.Provider.Google()
            }).addTo(mapJs.currentMap);
        }
        $('#filter-map').show();
    },
    addBalloon:function(params){
        var marker = L.marker([params.lat,params.lon],{draggable:params.draggable});
            marker.bindPopup(params.text);
        if(params.cluster){
            mapJs.markersCluster.addLayer(marker);
        }
        else{
            marker.addTo(mapJs.currentMap);
        }

        if(params.draggable==true){
            marker.on('dragend', function(e) {
                var latLng = e.target._latlng;
                mapJs._setCords({lat:latLng.lat,lon:latLng.lng});
            });
        }
        if(params.ajaxBalloon==true){
            marker.on('click', function(e) {
                var $mapObject = $(mapJs.currentMap._container);
                $mapObject.find('.ajax-balloon').remove();
                $.ajax({
                    type: "GET",
                    url: "/project/mapInfo",
                    data: {id:params.id}
                }).done(function( data ) {
                    $mapObject.find('.ajax-balloon').remove();
                    $mapObject.prepend(data);
                });
                mapJs.currentMap.panTo(marker.getLatLng());
                return false;
            });

        }

        this._setCords(params);
    },
    addCluster:function(){
        mapJs.currentMap.addLayer(mapJs.markersCluster);
    },
    /**
     * Записать в инпуты координаты
     * @param params
     */
    _setCords:function(params){

        var $lat = $(mapJs.selectorLat),
            $lon = $(mapJs.selectorLon);
            $lat.val(params.lat);
            $lon.val(params.lon);
    }

}

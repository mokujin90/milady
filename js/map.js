var mapJs ={
    currentMap:null,
    selectorLat:'#coords-lat',
    selectorLon:'#coords-lon',
    init:function(params){
        console.log(params);
        var mapSetting = {};

        mapJs.currentMap = L.map(params.id,mapSetting).setView([params.lat,params.lon ], params.zoom);
        L.tileLayer('https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="http://mapbox.com">Mapbox</a>',
            id: 'examples.map-i875mjb7'
        }).addTo(mapJs.currentMap);

    },
    addBalloon:function(params){
        var marker = L.marker([params.lat,params.lon],{draggable:params.draggable});
            marker.bindPopup(params.text);
            marker.addTo(mapJs.currentMap);
        if(params.draggable==true){
            marker.on('dragend', function(e) {
                var latLng = e.target._latlng;
                mapJs.setCords({lat:latLng.lat,lon:latLng.lng});
            });
        }
        this.setCords(params);
    },
    /**
     * Записать в инпуты координаты
     * @param params
     */
    setCords:function(params){
        var $lat = $(mapJs.selectorLat),
            $lon = $(mapJs.selectorLon);
            $lat.val(params.lat);
            $lon.val(params.lon);
    }

}

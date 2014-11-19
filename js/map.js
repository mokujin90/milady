var mapJs ={
    currentMap:null,
    init:function(params){
        mapJs.currentMap = L.map(params.id).setView([params.lat,params.lon ], params.zoom);
        L.tileLayer('https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="http://mapbox.com">Mapbox</a>',
            id: 'examples.map-i875mjb7'
        }).addTo(mapJs.currentMap);
    },
    addBalloon:function(params){
        var marker = L.marker([params.lat,params.lon]).addTo(mapJs.currentMap);
    }
}

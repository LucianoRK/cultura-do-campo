
var localProdutor;
var nothing;
var pointHopper;
var map;



function initMapbox(data) {
    localProdutor = [data.origem.lng, data.origem.lat];
    nothing = turf.featureCollection([]);
    pointHopper = {};

//    mapboxgl.accessToken = 'pk.eyJ1IjoiY3VsdHVyYS1kby1jYW1wbyIsImEiOiJjam50cXllYmswNGppM3FucnloNGo4aGI0In0._AJQpBK97KUVkVeVH56GaQ'; // nosso token
    mapboxgl.accessToken = 'pk.eyJ1Ijoic2FyYWhrbGVpbnMiLCJhIjoiY2l5b2pmdDNnMDA1bTJ4cGZneDFqMmx1ZyJ9.i8GsZn75pDMDHnFdj6fRuw'; // token surrupiado

    map = new mapboxgl.Map({
        container: 'entrega_mapbox', // container id
//        style: 'mapbox://styles/cultura-do-campo/cjo378jak3dbx2rnx6o9cy2eh',
//style: 'mapbox://styles/cultura-do-campo/cjnujd37q111j2sp7xkwa74gh',
        style: 'mapbox://styles/mapbox/light-v9', // stylesheet location
        center: localProdutor, // starting position
        zoom: 12.90
    });

    map.on('load', function () {
        var marker = document.createElement('div');
        marker.classList = 'produtor pulse';
        new mapboxgl.Marker(marker).setLngLat(localProdutor).addTo(map);

        map.addSource('route', {
            type: 'geojson',
            data: nothing
        });

        map.addLayer({
            id: 'routeline-active',
            type: 'line',
            source: 'route',
            layout: {
                'line-join': 'round',
                'line-cap': 'round'
            },
            paint: {
                'line-color': '#ff0000',
                'line-width': {
                    base: 2,
                    stops: [[12, 3], [22, 12]]
                }
            }
        });

        map.addLayer({
            id: 'routearrows',
            type: 'symbol',
            source: 'route',
            layout: {
                'symbol-placement': 'line',
                'text-field': '▶',
                'text-size': {
                    base: 1,
                    stops: [[12, 24], [22, 60]]
                },
                'symbol-spacing': {
                    base: 1,
                    stops: [[12, 30], [22, 160]]
                },
                'text-keep-upright': false
            },
            paint: {
                'text-color': '#3887be',
                'text-halo-color': 'hsl(55, 11%, 96%)',
                'text-halo-width': 3
            }
        }, 'waterway-label');



//        map.on('click', function (e) {
//            newDropoff(map.unproject(e.point));
//        });


        createCoordsArray(data.clientes);
    });
}


function newDropoff(coords) {
    var pt = turf.point(
            [coords.lng, coords.lat],
            {
                orderTime: Date.now(),
                key: Math.random()
            }
    );
    pointHopper[pt.properties.key] = pt;


}

function callMapApi() {
    $.ajax({
        method: 'GET',
        url: assembleQueryURL()
    }).done(function (data) {
        var routeGeoJSON = turf.featureCollection([turf.feature(data.trips[0].geometry)]);
        // If there is no route provided, reset
        if (!data.trips[0]) {
            routeGeoJSON = nothing;
        } else {
            var numEntregas = data.waypoints.length - 1;
            var km = data.trips[0].distance * 0.001;
            var km_round = Math.round(km * 100) / 100;

            var minutes = data.trips[0].duration * 0.0166667;

            var hours = Math.floor(minutes / 60);
            var minutos = minutes % 60;
            $("#distancia").html(km_round + " Km");

            $("#tempo").html(hours + "h" + Math.round(minutos) + "min");
            $("#num_entregas").html(numEntregas + " entregas");

            map.getSource('route').setData(routeGeoJSON);
            updateMarkers(data.waypoints);
        }
        if (data.waypoints.length === 12) {
            window.alert('Máximo de 12 pontos. mapbox.com/api-documentation/#optimization.');
        }
    });
}



function updateMarkers(waypoints) {
    waypoints.forEach(function (d, i) {
        var el = document.createElement('div');
        el.className = 'marker';
        if (d.waypoint_index > 0) {
            el.textContent = d.waypoint_index;
            new mapboxgl.Marker(el).setLngLat(d.location).addTo(map);
        }
    });
}


function assembleQueryURL() {
    // Store the location of the produtor in a variable called coordinates
    var coordinates = [localProdutor];
    var distributions = [];
    // Create an array of GeoJSON feature collections for each point
    var restJobs = objectToArray(pointHopper);
    if (restJobs.length > 0) {
        restJobs.forEach(function (d, i) {
            coordinates.push(d.geometry.coordinates);
            distributions.push(0 + ',' + (coordinates.length - 1));
        });
    }
    var url = 'https://api.mapbox.com/optimized-trips/v1/mapbox/driving/' + coordinates.join(';') + '?distributions=' + distributions.join(';') + '&overview=full&steps=true&geometries=geojson&source=first&access_token=' + mapboxgl.accessToken;
    return url;
}

function objectToArray(obj) {
    var keys = Object.keys(obj);
    var routeGeoJSON = keys.map(function (key) {
        return obj[key];
    });
    return routeGeoJSON;
}

function createCoordsArray(clientes) {
    clientes.forEach(function (cliente) {
        var coords = {lng: cliente.endereco.lng, lat: cliente.endereco.lat};
        newDropoff(coords);
    });
    callMapApi();
}
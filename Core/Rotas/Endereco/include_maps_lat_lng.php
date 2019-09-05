<div class="form-group m-form__group row">
    <div class="col-md-12">
        <div class="col-md-12">

            <div class="btn-group mr-2" role="group" aria-label="Second group">
                <button type="button" id="me_encontre" class="btn btn-dark"><span class="flaticon-map-location m--margin-right-10"></span>Usar geolocalização</button>
                <button type="button" id="reset_geolocation" class="btn btn-danger" disabled><span class="fa  fa-times "></span></button>
            </div>
            <br>
            <span class="m-form__help">Use este botão <strong>somente</strong> caso você esteja na propriedade rural</span>

        </div>
    </div>

</div>
<?php include 'Core/Rotas/Endereco/include_endereco_completo.php'; ?>

<div style="display: none;" id="load_input_estado_municipio">

</div>
<style>
    #map {
        height: 500px;
        width: 100%;
        border: 1px solid rgba(0,0,0,0.45);
        border-radius: 5px;
    }

    #map-report div.gmnoprint,
    #map-report div.gmnoscreen,
    .gmnoprint, .gm-style-cc{
        display: none;      
    }

</style>
<div class="form-group m-form__group row">
    <div class="col-md-12">
        <div class="col-md-12">
            <label>Comunidade (Opcional)</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="flaticon-pin"></i>
                    </span>
                </div>

                <input type="text" class="form-control" placeholder="Informe o local ou comunidade" name="comunidade">
                <div class="input-group-append">
                    <button id="localizar_comunidade" class="btn btn-info btn-" type="button"><strong>Localizar local<span></span></strong></button>
                </div>
            </div>
            <span class="m-form__help text-info">Use o botão '<u>Localizar local</u>' ou pressione [ENTER]</span>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="form-group m-form__group row">

        <div class="col-md-12">

            <div id="map"></div>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Latitude
                    </span>
                </div>

                <input readonly="" type="text" class="form-control" name="lat" value="0.0000">

            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Longitude
                    </span>
                </div>

                <input readonly="" type="text" class="form-control" name="lng" value="0.0000">

            </div>
        </div>
    </div>
</div>



<script>

    var mapObject;
    var marker;
    var image = 'Public/Images/Outros/marker.png';
    var startPos = {lat: -15.4861792, lng: -51.7487035};

    $(document).ready(function () {
        initMap();
        showLatLngPos(startPos.lat, startPos.lng);
        setMarker(startPos);


        $("#localizar_comunidade").off("click");
        $("#localizar_comunidade").on("click", function () {
            localizarComunidade();
        });

        $("input[name=comunidade]").off("keyup")
        $("input[name=comunidade]").on("keyup", function (event) {
            if (event.keyCode === 13) {
                localizarComunidade();
            }
        });

        $("#me_encontre").off("click");
        $("#me_encontre").on("click", function () {
            blockPage();

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    $("#include_estado_municipio").slideUp();
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    mapObject.setZoom(15);
                    panTo(pos);
                    geocodeLatLng(pos.lat, pos.lng);
                }, function () {
                    alert("Não foi possível encontrar a localização");
                    unblockPage();
                });
            } else {
                alert("Este navegador não suporta geolocalização");
            }
        });

        $("#reset_geolocation").off("click");
        $("#reset_geolocation").on("click", function () {
            blockPage();
            $(this).attr("disabled", true);
            $("#cep").val("");
            $("input[name=bairro]").val("");
            $("input[name=logradouro]").val("");
            $("input[name=numero]").val("");

            $("#load_input_estado_municipio").slideUp();
            $("#include_estado_municipio select").prop("disabled", false);
            $('#include_estado_municipio .selectpicker').selectpicker('refresh');
            $("#include_estado_municipio input").prop("disabled", false);
            setTimeout(function () {
                mapObject.setZoom(4);
                mapObject.panTo(startPos);
                $("#load_input_estado_municipio").html("");
                $("#include_estado_municipio").slideDown();
                $("input[name=comunidade]").val("");
                showLatLngPos("0.0000", "0.0000");
                if (typeof marker === "object") {
                    marker.setMap(null);
                }
                unblockPage();
            }, 1000);

        });
    });

    function initMap() {
        mapObject = new google.maps.Map(document.getElementById('map'), {
            center: startPos,
            zoom: 4,
            mapTypeId: google.maps.MapTypeId.HYBRID,
            zoomControl: true,
            zoomControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            }

        });

        google.maps.event.addListener(mapObject, "click", function (e) {
            var lat = e.latLng.lat();
            var lng = e.latLng.lng();
            showLatLngPos(lat, lng);
            setMarker(e.latLng);
        });

    }

    function geocoding(address, zoom) {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({'address': address}, function (results, status) {
            if (status === 'OK') {
                mapObject.setZoom(zoom);
                mapObject.panTo(results[0].geometry.location);
                panTo(results[0].geometry.location);
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
            unblockPage();
        });
    }


    function setMarker(pos) {
        if (typeof marker === "object") {
            marker.setMap(null);
        }
        marker = new google.maps.Marker({
            position: pos,
            map: mapObject,
            animation: google.maps.Animation.DROP,
            icon: image
        });
    }

    function showLatLngPos(lat, lng) {
        $("input[name=lat]").val(lat);
        $("input[name=lng]").val(lng);
    }

    function panTo(pos) {
        showLatLngPos(pos.lat, pos.lng);
        mapObject.panTo(pos);
        setMarker(pos);
    }

    function localizarComunidade() {
        var codigo = $("#municipio").val();
        var siglaEstado = $("#uf").val();
        var municipio = $("#municipio option[value='" + codigo + "']").text();
        var comunidade = $("input[name=comunidade]").val();
        var estado = $("#uf option[value='" + siglaEstado + "']").text();
        geocoding("Brasil, " + estado + ", " + municipio + ", " + comunidade, 15);
    }

    function geocodeLatLng(lat, lng) {
        var geocoder = new google.maps.Geocoder();
        var latlng = {lat: lat, lng: lng};
        geocoder.geocode({'location': latlng}, function (results, status) {
            if (status === 'OK') {
                if (results[0]) {
                    console.log(results[0]);

                    var cep = results[0]['address_components'][6]['long_name'];
                    var bairro = results[0]['address_components'][2]['long_name'];
                    var logradouro = results[0]['address_components'][1]['long_name'];

                    $("input[name=cep]").val(cep);
                    $("input[name=bairro]").val(bairro);
                    $("input[name=logradouro]").val(logradouro);

                    var geo_estado_short = results[0]['address_components'][4]['short_name'];
                    var geo_estado_long = results[0]['address_components'][4]['long_name'];

                    var geo_municipio = results[0]['address_components'][3]['long_name'];
                    var geo_local = results[0]['address_components'][2]['long_name'] + ", " + results[0]['address_components'][1]['long_name'];
                    $("#reset_geolocation").attr("disabled", false);
                    $("#include_estado_municipio select").prop("disabled", true);
                    $('#include_estado_municipio .selectpicker').selectpicker('refresh');
                    $("#include_estado_municipio input").prop("disabled", true);
                    $("#load_input_estado_municipio").load("load/input/estado/municipio",
                            {estado_long: geo_estado_long, estado_short: geo_estado_short, municipio: geo_municipio}, function () {
                        $("#load_input_estado_municipio").slideDown();
//                        $("input[name=comunidade]").val(geo_local);
                    });
                } else {
                    window.alert('No results found');
                }
            } else {
                window.alert('Geocoder failed due to: ' + status);
            }
            unblockPage();

        });
    }

</script>
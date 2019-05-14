<?php
require("dbconn.php");

if (isset($_POST["locales"])){
    $locales = $_POST["locales"];


}   

$sql = "SELECT * FROM markers WHERE type = 'bar'"



?>
<!DOCTYPE html>
<html>

<head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
        /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
        #map {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 100%;
            margin: 10px;
            padding: 0;
        }
    </style>
</head>

<body>
    <div id="options">
        Elige un tipo de local:
        <form action="" method="post">
            <select name="locales" id="locales">
                <option value="restaurant">Restaurantes</option>
                <option value="bar">Bares</option>
                <option value="disco">Discotecas</option>
            </select>
            <button type="submit">Consultar</button>
        </form>
    </div>
    <br>
    <div id="map" style="height: 50%; width: 50%"></div>
    <script>
        var map;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -34.397,
                    lng: 150.644
                },
                zoom: 8
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSv_CsQYfLsBgcMgoWZvDnxGyDtJudY58&callback=initMap" async defer></script>
</body>

</html>
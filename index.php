<?php
require("dbconn.php");
if (isset($_POST["locales"])){
    $locales = $_POST["locales"];
}
else{
    $locales = " ";
}  

$sql = "SELECT * FROM markers WHERE type = '$locales'";
$result = mysqli_query($conn, $sql);

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
        <form action="" method="post">
        Elige un tipo de local:
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
                    lat: -33.898113,
                    lng: 151.174469
                },
                zoom: 11
            });  

            <?php
            $i = 0;            
            while($fila = mysqli_fetch_array($result)){
                extract($fila);       
            ?> 
                var contentString = '<?php echo "$name"; ?>';
		        var infowindow<?php echo $i;?> = new google.maps.InfoWindow({
		    	    content: contentString
                });                   
                var myLatLng = {lat:<?php echo "$lat";?>, lng:<?php echo "$lng";?>};
                var marker<?php echo $i;?> = new google.maps.Marker({
		            position: myLatLng,
		            map: map,
		            title: '<?php echo "$name"; ?>'
		        });
                marker<?php echo $i;?>.addListener('click', function() {
		    	infowindow<?php echo $i;?>.open(map, marker<?php echo $i;?>);
		  		});
            <?php
                $i++;
            }
            ?>
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSv_CsQYfLsBgcMgoWZvDnxGyDtJudY58&callback=initMap" async defer></script>
</body>

</html>
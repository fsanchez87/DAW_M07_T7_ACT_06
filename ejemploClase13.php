<?php
/*
create database googlemaps;
use googlemaps;

create table marcadores(
id int auto_increment primary key,
nombre varchar(100),
coordenadas varchar(100));

insert into marcadores(nombre, coordenadas) values('Marcador1', '{lat: 41.3818, lng: 2.1685}');
insert into marcadores(nombre, coordenadas) values('Marcador2', '{lat: 41.3518, lng: 2.1685}');
insert into marcadores(nombre, coordenadas) values('Marcador3', '{lat: 41.3818, lng: 2.1585}');
*/

$con = mysqli_connect('localhost', 'root', '12345', 'googlemaps') or die ("ERROR");
$query = 'select * from marcadores';
$result = mysqli_query($con, $query);
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
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map" style='height:50%; width:50%'></div>
    <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 41.3818, lng: 2.1685},
          zoom: 13
        });

        <?php
        	$i = 0;
        	while($fila=mysqli_fetch_array($result)){
        		extract($fila);
        ?>
		        var contentString = '<?php echo "$nombre"; ?>';
		        var infowindow<?php echo $i;?> = new google.maps.InfoWindow({
		    		content: contentString
		  		});
		        var marker<?php echo $i;?> = new google.maps.Marker({
		        	position: <?php echo "$coordenadas";?>,
		        	map: map,
		        	title: '<?php echo "$nombre"; ?>'
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgV9GFzHFfH7_9yzuB6ZigYjFK3bt88no&callback=initMap"
    async defer></script>
  </body>
</html>
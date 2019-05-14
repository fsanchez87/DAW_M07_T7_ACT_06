<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "maps";

    // Crear la conexión
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Comprobar la conexión
    if (!$conn){
        die ("Error: " .mysqli_connect_error());
    }
?>
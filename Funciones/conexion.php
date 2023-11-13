
<?php

//Aqui pones tu HOST (LocalHost) si tu servidor esta en casa
$host = "localhost";
//Aqui el nombre de usuario 
$nombre= "profitech"; 
//Aqui la contraseña
$contraseña="Admin1234"; 

try {
    $conexion = new PDO('mysql:host='.$host.';dbname=bolsa_emplea', $nombre, $contraseña);
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
    exit;
}    

?>


<!-- Control de errores -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>



<!-- Provisional -->
    <link rel="shortcut icon" href="/Imagenes/Icon/icon.png">

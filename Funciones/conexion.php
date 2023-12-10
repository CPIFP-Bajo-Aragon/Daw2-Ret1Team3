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



<!-- Mostrar Alertas -->
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$dni = $_SESSION["dni"];

if (!isset($dni)) {
     header('Location: /');
      exit;
     }


$sqlcargaalerta = "SELECT COUNT(*) AS NumeroDeAlertas FROM Alertas WHERE DNI_CIF = '$dni' AND Vista = 1";

$result = $conexion->query($sqlcargaalerta);
while ($row_nombre_destino = $result->fetch(PDO::FETCH_OBJ)) {
    $NumeroDeAlertas = $row_nombre_destino->NumeroDeAlertas;
}
$_SESSION['numalertas']=$NumeroDeAlertas;
?>
<script>
document.getElementById('num_alerta').innerHTML = "Mis Alertas: <?php echo  $NumeroDeAlertas?> ";
</script>
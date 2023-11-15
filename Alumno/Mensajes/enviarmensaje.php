<?php 
    include "../../Funciones/conexion.php";
    session_start();
    $dni_origen=$_SESSION['dni'];
    $dni_destino=$_POST['dni_destino'];
    $mensaje = $_POST['mensaje'];
    
    $sentencia = $conexion->prepare("INSERT INTO Mensaje (Origen_Mensaje, Destino_Mensaje, Mensaje) VALUES (?, ?, ?)");
    $sentencia->bindParam(1, $dni_origen);
    $sentencia->bindParam(2, $dni_destino);
    $sentencia->bindParam(3, $mensaje);
         
try {
    $sentencia->execute();
    header ('Location: mensaje.php');

} catch (PDOException $e) {
    header ('Location: mensaje.php');
}
?>
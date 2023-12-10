<?php session_start();
include "../../../Funciones/conexion.php"; 
?> 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php 
$id = $_POST['Id_Experiencia_Laboral'];
$nombre_Empresa = $_POST['nombre'];
$puesto = $_POST['Puesto'];
$descripcion = $_POST['Descripcion'];
$fecha_inicio = $_POST['Fecha_Inicio'];
$fecha_fin = $_POST['Fecha_Fin'];
$dni=$_SESSION['dni'];


$sentencia = $conexion->prepare("UPDATE Experiencia_Laboral SET Nombre_Empresa = ?, Puesto = ?, Descripcion = ?, Fecha_Inicio = ?, Fecha_Fin = ?  WHERE DNI_CIF = ? AND ID_Experiencia_Laboral= ?");
$sentencia->bindParam(1, $nombre_Empresa);
$sentencia->bindParam(2, $puesto);
$sentencia->bindParam(3, $descripcion);
$sentencia->bindParam(4, $fecha_inicio);
$sentencia->bindParam(5, $fecha_fin);
$sentencia->bindParam(6, $dni);
$sentencia->bindParam(7, $id);


try {
    $sentencia->execute();
    header("Location: ../index.php#Experiencia_Laboral");

} catch (PDOException $e) {
    header("Location: ../index.php");
    
}
?> 
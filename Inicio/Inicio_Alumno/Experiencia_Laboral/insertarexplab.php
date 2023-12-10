<?php
include "../../../Funciones/conexion.php";
include "../../Funciones/SessionStart.php";
session_start();
$nombre_empresa = $_POST['Nombre'];
$puesto = $_POST['Puesto'];
$descripcion = $_POST['Descripcion'];
$fecha_inicio = $_POST['Fecha_Inicio'];
$fecha_fin = $_POST['Fecha_Fin'];
$dni=$_SESSION['dni'];


if(!empty($fecha_fin)){
    $sentencia = $conexion->prepare("INSERT INTO Experiencia_Laboral (Nombre_empresa, Puesto, Descripcion, Fecha_Inicio, Fecha_Fin, DNI_CIF) VALUES (?, ?, ?, ?, ?, ?)");
$sentencia->bindParam(1, $nombre_empresa);
$sentencia->bindParam(2, $puesto);
$sentencia->bindParam(3, $descripcion);
$sentencia->bindParam(4, $fecha_inicio);
$sentencia->bindParam(5, $fecha_fin);
$sentencia->bindParam(6, $dni);

try {
    if($fecha_inicio>$fecha_fin){
        echo "<script>";
        echo "alert('la fecha inicio no puede ser menor que la fecha fin')";
        echo "</script>";
        echo "<script>";
        echo "location.replace('../index.php#Experiencia_Laboral')";
        echo "</script>";
    }
    $sentencia->execute();
    header("Location: ../index.php#Experiencia_Laboral");

} catch (PDOException $e) {
    header("Location: ../index.php");
    
}

}else{

    $sentencia = $conexion->prepare("INSERT INTO Experiencia_Laboral (Nombre_empresa, Puesto, Descripcion, Fecha_Inicio, DNI_CIF) VALUES (?, ?, ?, ?, ?)");
    $sentencia->bindParam(1, $nombre_empresa);
    $sentencia->bindParam(2, $puesto);
    $sentencia->bindParam(3, $descripcion);
    $sentencia->bindParam(4, $fecha_inicio);
    $sentencia->bindParam(5, $dni);
    
    try {
        


        $sentencia->execute();
        header("Location: ../index.php#Experiencia_Laboral");
    
    } catch (PDOException $e) {
        header("Location: ../index.php");
        
    }
}



?>
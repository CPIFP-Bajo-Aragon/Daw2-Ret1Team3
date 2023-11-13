<?php 
include "../../../Funciones/conexion.php";
include "../../Funciones/SessionStart.php";
session_start();
$dni=$_SESSION['DNI_CIF'];
$id = $_POST['id'];

$sentencia = $conexion->prepare("DELETE FROM Experiencia_Laboral WHERE Id_Experiencia_Laboral = ? ");
$sentencia->bindParam(1, $id);

  try {
    $sentencia->execute();
    echo "Se ha borrado con exito";
    header("Location: ../index.php#Experiencia_Laboral");

} catch (PDOException $e) {
  echo "Error al borrar la consulta";
  header("Location: ../index.php#Experiencia_Laboral");
    
}

?> 
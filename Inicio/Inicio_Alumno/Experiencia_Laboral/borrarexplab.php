<?php 
include "../../Funciones/SessionStart.php";
include "../../../Funciones/conexion.php";

$dni=$_SESSION['DNI_CIF'];
$id = $_POST['id_exp'];


$sentencia = $conexion->prepare("DELETE FROM Experiencia_Laboral WHERE Id_Experiencia_Laboral = ? ");
$sentencia->bindParam(1, $id);

if (($_POST['confirmacionEliminacion3']=='true')) {
  try {
    $sentencia->execute();
    echo "Se ha borrado con exito";
    header("Location: ../index.php#Experiencia_Laboral");

} catch (PDOException $e) {
  echo "Error al borrar la consulta";
  header("Location: ../index.php#Experiencia_Laboral");
    
}
}else{
  header("Location: ../index.php#Experiencia_Laboral");
}
?> 

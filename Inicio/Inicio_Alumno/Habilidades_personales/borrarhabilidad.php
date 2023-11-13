<?php
include "../../../Funciones/conexion.php";
  
session_start();
$dni=$_SESSION['dni'];
$id_soft = $_POST['id_soft'];
$query = "DELETE FROM Soft_Skill_Alumno WHERE Id_Soft = $id_soft AND DNI_CIF = '$dni'";

  
try {
    $conexion->query($query);
    echo "Se ha borrado con exito";
    header("Location: ../index.php#habper");

} catch (PDOException $e) {
  echo "Error al borrar la consulta";
  header("Location: ../index.php#habper");
    
}




?> 

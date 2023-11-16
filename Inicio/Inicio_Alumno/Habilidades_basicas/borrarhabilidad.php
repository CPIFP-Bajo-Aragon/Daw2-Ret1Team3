<?php

include "../../../Funciones/conexion.php";
  
session_start();
$dni=$_SESSION['dni'];
$id_Hard = $_POST['id_Hard'];
$query = "DELETE FROM Hard_Skill_Alumno WHERE Id_Hard=$id_Hard AND DNI_CIF='$dni'";
try {
    $conexion->query($query);
    echo "Se ha borrado con exito";
    header("Location: ../index.php#habbas");

} catch (PDOException $e) {
  echo "Error al borrar la consulta";
  header("Location: ../index.php#habbas");
    
}



?> 

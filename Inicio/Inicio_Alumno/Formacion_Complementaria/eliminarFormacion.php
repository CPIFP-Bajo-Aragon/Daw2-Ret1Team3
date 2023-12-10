<?php 
include "../../Funciones/SessionStart.php";
include "../../../Funciones/conexion.php";
$dni=$_SESSION['dni'];
$id = $_POST['id_Formacion'];
$query = "DELETE FROM Formacion_Complementaria WHERE Id_Formacion_Complementaria = $id ";

if (($_POST['confirmacionEliminacion']=='true')) {
  try {
    $conexion->query($query);
    echo "Se ha borrado con exito";
    header("Location: ../index.php#Formacion_complementaria");
} catch (PDOException $e) {
    echo "Error al borrar la consulta";
    header("Location: ../index.php#Formacion_complementaria");
}
}else{
  header("Location: ../index.php#Formacion_complementaria");
}
?> 
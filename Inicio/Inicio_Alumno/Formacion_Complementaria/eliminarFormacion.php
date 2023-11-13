<?php 
include "../../../Funciones/conexion.php";
session_start();
$dni=$_SESSION['dni'];
$id = $_POST['id_Formacion'];
$query = "DELETE FROM Formacion_Complementaria WHERE Id_Formacion_Complementaria = $id ";
  try {
    $conexion->query($query);
    echo "Se ha borrado con exito";
    header("Location: ../index.php#Formacion_complementaria");
} catch (PDOException $e) {
    echo "Error al borrar la consulta";
    header("Location: ../index.php#Formacion_complementaria");
}
?> 
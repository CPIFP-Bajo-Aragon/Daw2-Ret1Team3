<?php
include "../../Funciones/SessionStart.php";
include "../../../Funciones/conexion.php";

session_start();

$Id_Centro = $_POST['Id_Centro'];
$Id_Tipo_Titulacion = $_POST['Id_Tipo_Titulacion'];
$dni = $_SESSION['dni'];


$sentencia = $conexion->prepare("DELETE FROM Titulacion_Centro_Persona WHERE DNI_CIF = ? AND Id_Centro = ? AND Id_Tipo_Titulacion = ?");
$sentencia->bindParam(1, $dni);
$sentencia->bindParam(2, $Id_Centro);
$sentencia->bindParam(3, $Id_Tipo_Titulacion);


try {
  $sentencia->execute();
    echo "Se ha borrado con exito";
    header("Location: ../");

} catch (PDOException $e) {
  echo "Error al borrar la consulta";
    
}

?>






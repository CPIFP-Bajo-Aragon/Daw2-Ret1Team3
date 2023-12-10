<?php 
include "../../../Funciones/conexion.php";

$dni=$_SESSION['dni'];
$Idioma = $_POST['id_Idioma'];

$query = "DELETE FROM Nivel_Idioma WHERE Id_Idioma = $Idioma AND DNI_CIF='$dni'";

  try {
    $conexion->query($query);
    echo "Se ha borrado con exito";
    header("Location: ../index.php#idiomas");
} catch (PDOException $e) {
    echo "Error al borrar la consulta";
    header("Location: ../index.php#idiomas");
}
?>
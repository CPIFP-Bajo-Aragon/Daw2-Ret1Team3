<?php
include "../../Funciones/conexion.php";

$id_alerta = $_POST['id'];
$sql_update = "UPDATE Alertas SET Vista=0 WHERE Id_Alerta=$id_alerta";
echo $sql_update;

$stmt = $conexion->prepare($sql_update);
$stmt->execute();

header("location: index.php");
?>

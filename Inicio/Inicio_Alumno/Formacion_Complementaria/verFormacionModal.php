<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
include "../../../Funciones/conexion-inicio.php";

$Id_Formacion_Complementaria = $_GET['Id_Formacion_Complementaria'];

// Consulta para obtener los centros
$query = "SELECT * FROM Formacion_Complementaria WHERE Id_Formacion_Complementaria='$Id_Formacion_Complementaria'";
$stmt = $conexion->query($query);
$centros = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Devolver los resultados como JSON
echo json_encode($centros);
?>

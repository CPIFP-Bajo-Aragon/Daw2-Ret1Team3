<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
include "../../../Funciones/conexion-inicio.php";

// Consulta para obtener los centros
$query = "SELECT * FROM Idioma";
$stmt = $conexion->query($query);
$idiomas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Devolver los resultados como JSON
echo json_encode($idiomas);
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
include "../../../Funciones/conexion-inicio.php";

// Consulta para obtener los centros
$query = "SELECT Id_Tipo_Titulacion, Nombre, Tipo FROM Titulacion";
$stmt = $conexion->query($query);
$titulos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Devolver los resultados como JSON
echo json_encode($titulos);
?>



<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
include "../../../Funciones/conexion-inicio.php";

$Id_Experiencia_Laboral = $_GET['Id_Experiencia_Laboral'];

// Consulta para obtener los centros
$query = "SELECT * FROM Experiencia_Laboral WHERE Id_Experiencia_Laboral ='$Id_Experiencia_Laboral'";
$stmt = $conexion->query($query);
$experienciaLaboral = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Devolver los resultados como JSON
echo json_encode($experienciaLaboral);
?>

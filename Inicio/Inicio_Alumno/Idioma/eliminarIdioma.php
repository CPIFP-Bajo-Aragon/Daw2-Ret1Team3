<?php 
include "../../../Funciones/conexion.php";
session_start();

$dni=$_SESSION['dni'];
$Idioma = $_POST['Idioma'];

$query = "DELETE FROM Nivel_Idioma WHERE Id_Idioma = '$Idioma'";


$sentencia = $conexion->prepare("INSERT INTO Nivel_Idioma (Id_Idioma) VALUES (?)");
$sentencia->bindParam(1, $Idioma);

  try {
    $conexion->query($query);
    header("Location: ../index.php#Idioma");
} catch (PDOException $e) {

    header("Location: ../index.php#Idioma");
}

?> 
<?php 
include "../../Funciones/conexion.php";

$idoferta = $_SESSION['ultimoID'];
$Hard = $_POST['Hard'];


$sentencia = $conexion->prepare("INSERT INTO Oferta_Hard_Skill (Id_Oferta, Id_Hard) VALUES (?, ?)");
$sentencia->bindParam(1, $idoferta);
$sentencia->bindParam(2, $Hard);

 


 try {
    $sentencia->execute();
    header("Location: Objetos_Oferta.php");


} catch (PDOException $e) {
    header("Location: Objetos_Oferta.php");

}

?>
<?php 
include "../../Funciones/conexion.php";

$idoferta = $_SESSION['ultimoID'];
$Soft = $_POST['Soft'];


$sentencia = $conexion->prepare("INSERT INTO Oferta_Soft_Skill (Id_Oferta, Id_Soft) VALUES (?, ?)");
$sentencia->bindParam(1, $idoferta);
$sentencia->bindParam(2, $Soft);

 


 try {
    $sentencia->execute();
    header("Location: Objetos_Oferta.php");


} catch (PDOException $e) {
    header("Location: Objetos_Oferta.php");

}

?>
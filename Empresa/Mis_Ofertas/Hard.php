<?php 
include "../../Funciones/conexion.php";
session_start();
$Id_Oferta = $_POST['Id_Oferta'];
$Id_Hard = $_POST['Id_Hard'];


$sentencia = $conexion->prepare("INSERT INTO Oferta_Hard_Skill (Id_Oferta, Id_Hard) VALUES (?, ?)");
$sentencia->bindParam(1, $Id_Oferta);
$sentencia->bindParam(2, $Id_Hard);

 


 try {
    $sentencia->execute();
    header("Location: editarOferta.php?Id_Oferta=" . $Id_Oferta);


} catch (PDOException $e) {
    header("Location: editarOferta.php?Id_Oferta=" . $Id_Oferta);

}

?>
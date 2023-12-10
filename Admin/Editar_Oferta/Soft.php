<?php 
include "../../Funciones/conexion.php";
session_start();
$Id_Oferta = $_POST['Id_Oferta'];
$Id_Soft = $_POST['Id_Soft'];


$sentencia = $conexion->prepare("INSERT INTO Oferta_Soft_Skill (Id_Oferta, Id_Soft) VALUES (?, ?)");
$sentencia->bindParam(1, $Id_Oferta);
$sentencia->bindParam(2, $Id_Soft);

 


 try {
    $sentencia->execute();
     header("Location: editarOferta.php?Id_Oferta=".$Id_Oferta);


} catch (PDOException $e) {
     header("Location: editarOferta.php?Id_Oferta=".$Id_Oferta);

}

?>
<?php 
include "../../Funciones/conexion.php";
session_start();
$Id_Oferta = $_POST['Id_Oferta'];
$Id_Titulacion = $_POST['Id_Titulacion'];


$sentencia = $conexion->prepare("INSERT INTO Oferta_Tipo_Titulacion (Id_Oferta, Id_Tipo_Titulacion) VALUES (?, ?)");
$sentencia->bindParam(1, $Id_Oferta);
$sentencia->bindParam(2, $Id_Titulacion);

 


 try {
    $sentencia->execute();
    header("Location: editarOferta.php?Id_Oferta=" . $Id_Oferta);


} catch (PDOException $e) {
    header("Location: editarOferta.php?Id_Oferta=" . $Id_Oferta);

}

?>
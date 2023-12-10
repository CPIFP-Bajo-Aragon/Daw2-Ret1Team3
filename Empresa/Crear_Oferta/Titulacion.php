<?php 
include "../../Funciones/conexion.php";

$idoferta = $_SESSION['ultimoID'];
$titulacion = $_POST['titulacion'];


$sentencia = $conexion->prepare("INSERT INTO Oferta_Tipo_Titulacion (Id_Oferta, Id_Tipo_Titulacion) VALUES (?, ?)");
$sentencia->bindParam(1, $idoferta);
$sentencia->bindParam(2, $titulacion);

 


 try {
    $sentencia->execute();
    header("Location: Objetos_Oferta.php");


} catch (PDOException $e) {
    header("Location: Objetos_Oferta.php");

}

?>
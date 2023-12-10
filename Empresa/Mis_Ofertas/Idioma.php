<?php 
include "../../Funciones/conexion.php";

$Nivel = $_POST['Nivel'];
$Idioma = $_POST['Idioma'];
$Id_Oferta = $_POST['Id_Oferta'];

$sentencia = $conexion->prepare("INSERT INTO Oferta_Nivel_Idioma (Id_Oferta, Id_Nivel, Id_Idioma) VALUES (?, ?, ?)");
$sentencia->bindParam(1, $Id_Oferta);
$sentencia->bindParam(2, $Nivel);
$sentencia->bindParam(3, $Idioma);



 try {
    $sentencia->execute();
    header("Location: editarOferta.php?Id_Oferta=" . $Id_Oferta);


} catch (PDOException $e) {
    header("Location: editarOferta.php?Id_Oferta=" . $Id_Oferta);

}

?>
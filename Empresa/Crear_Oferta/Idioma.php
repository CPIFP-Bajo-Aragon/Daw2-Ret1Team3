<?php
include "../../Funciones/conexion.php";

 $Idioma=$_POST['Idioma'];
 $Nivel=$_POST['Nivel'];
 $idoferta = $_SESSION['ultimoID'];

 $sentenciados = $conexion->prepare("INSERT INTO Oferta_Nivel_Idioma (Id_Oferta, Id_Nivel, Id_Idioma) VALUES (?, ?, ?)");

$sentenciados->bindParam(1, $idoferta);
$sentenciados->bindParam(2, $Nivel);
$sentenciados->bindParam(3, $Idioma);
 

try {
    $sentenciados->execute();
    header("Location: Objetos_Oferta.php");


} catch (PDOException $e) {
    header("Location: Objetos_Oferta.php");

}

?>
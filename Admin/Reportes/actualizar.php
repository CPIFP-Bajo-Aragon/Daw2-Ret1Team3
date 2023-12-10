<?php
include "../../Funciones/conexion.php";

$id=$_POST['id'];
$solucionado=0;
$sql=$conexion->prepare("UPDATE Reporte SET Solucionado=? WHERE Id_Reporte=?");
$sql->bindParam(1,$solucionado);
$sql->bindParam(2,$id);

try {
    $sql->execute();
    header("location:index.php");

} catch (PDOException $e) {
    echo $sql;
    header("location:index.php");

} 
?>
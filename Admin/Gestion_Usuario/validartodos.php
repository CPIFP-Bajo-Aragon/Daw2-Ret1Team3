<?php
$resultado=$_GET['result'];

include "../../Funciones/conexion.php";




if( $resultado=1){
    $sentencia = $conexion->query("UPDATE Alumno SET Activo=1 ");
    try {
        $sentencia->execute();
    
    } catch (PDOException $e) {
        header("Location: index.php");
        echo $sql;
    } 
}



header("Location: index.php");

?>
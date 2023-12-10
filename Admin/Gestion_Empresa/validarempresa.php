<?php
include "../../Funciones/conexion.php";

$dni = $_POST['id_dni'];



if(isset($_POST['validar'])){
    $activo=1;
    $sentencia = $conexion->prepare("UPDATE Empresa SET Activo=?  WHERE DNI_CIF = ?");
    $sentencia->bindParam(1, $activo);
    $sentencia->bindParam(2, $dni);
    }
    try {
        $sentencia->execute();
    
        // Insertar nueva alerta
        $nuevaAlerta = "Empresa Validada correctamente por un Administrador ";
        $vista = 1;
    
        $sentenciaInsert = $conexion->prepare("INSERT INTO Alertas (Alerta, DNI_CIF, Vista) VALUES (?, ?, ?)");
        $sentenciaInsert->bindParam(1, $nuevaAlerta);
        $sentenciaInsert->bindParam(2, $dni);
        $sentenciaInsert->bindParam(3, $vista);
        $sentenciaInsert->execute();
    
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

try {
    $sentencia->execute();
    header("Location: index.php");

} catch (PDOException $e) {
    header("Location: index.php");
    echo $sql;
} 

?>
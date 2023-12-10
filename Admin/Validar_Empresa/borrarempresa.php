<?php
include "../../Funciones/conexion.php";

$dni = $_POST['id_dni'];
$activo=2;

$sentencia = $conexion->prepare("UPDATE Empresa SET Activo=?  WHERE DNI_CIF = ?");
$sentencia->bindParam(1, $activo);
$sentencia->bindParam(2, $dni);


try {
    $sentencia->execute();

    // Insertar nueva alerta
    $nuevaAlerta = "❌ Empresa no validado por un Administrador  (Si esto es un error  <a target='_blank' href='../../Reportes/index.php'>contacta con un Administrador</a> para que lo reactive)";
    $vista = 1;

    $sentenciaInsert = $conexion->prepare("INSERT INTO Alertas (Alerta, DNI_CIF, Vista) VALUES (?, ?, ?)");
    $sentenciaInsert->bindParam(1, $nuevaAlerta);
    $sentenciaInsert->bindParam(2, $dni);
    $sentenciaInsert->bindParam(3, $vista);
    $sentenciaInsert->execute();

    header("Location: index.php");
} catch (PDOException $e) {
    header("Location: index.php");
    echo $e->getMessage();
}
?>

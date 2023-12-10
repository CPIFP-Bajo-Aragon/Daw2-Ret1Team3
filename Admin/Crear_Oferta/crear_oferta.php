<?php
include "../../Funciones/conexion.php";

$dni_empresa = $_POST['empresa'];
$titulo = $_POST['titulo'];
$vacantes = $_POST['vacantes'];
$descripcion = $_POST['descripcion'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$Id_Pais = $_POST['Pais'];
if ($Id_Pais!=73){
    $Id_municipio=8123;
}else {
$Id_municipio = $_POST['municipios'];
}
$movilidad=$_POST['Movilidad'];
$coche=$_POST['Coche'];


if (!isset($fecha_fin)) {
    $sentencia = $conexion->prepare("INSERT INTO Oferta (Titulo, Vacantes, Descripcion, Fecha_Inicio, Fecha_Fin, DNI_CIF, Id_Municipio, Id_Pais, Activo, Movilidad, Coche) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1,?,?)");
    $sentencia->bindParam(1, $titulo);
    $sentencia->bindParam(2, $vacantes);
    $sentencia->bindParam(3, $descripcion);
    $sentencia->bindParam(4, $fecha_inicio);
    $sentencia->bindParam(5, $fecha_fin);
    $sentencia->bindParam(6, $dni_empresa);
    $sentencia->bindParam(7, $Id_municipio);
    $sentencia->bindParam(8, $Id_Pais);
    $sentencia->bindParam(9, $movilidad);
    $sentencia->bindParam(10, $coche);
} else {

    $sentencia = $conexion->prepare("INSERT INTO Oferta (Titulo, Vacantes, Descripcion, Fecha_Inicio, DNI_CIF,Id_Municipio, Id_Pais, Activo, Movilidad,Coche) VALUES (?,?,?, ?, ?, ?, ?, 1,?,?)");
    $sentencia->bindParam(1, $titulo);
    $sentencia->bindParam(2, $vacantes);
    $sentencia->bindParam(3, $descripcion);
    $sentencia->bindParam(4, $fecha_inicio);
    $sentencia->bindParam(5, $dni_empresa);
    $sentencia->bindParam(6, $Id_municipio);
    $sentencia->bindParam(7, $Id_Pais);
    $sentencia->bindParam(8, $movilidad);
    $sentencia->bindParam(9, $coche);

}


try {

    $sentencia->execute();
    $vista = 1;
    $nuevaAlerta="Un Administrador te ha creado la siguiente oferta: ".$titulo;

                $sentenciaInsert = $conexion->prepare("INSERT INTO Alertas (Alerta, DNI_CIF, Vista) VALUES (?, ?, ?)");
                $sentenciaInsert->bindParam(1, nl2br($nuevaAlerta));
                $sentenciaInsert->bindParam(2, $dni_empresa);
                $sentenciaInsert->bindParam(3, $vista);
                $sentenciaInsert->execute();
    header("Location: index.php");
    exit();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<?php
include "../../Funciones/conexion.php";
session_start();
$dni = $_SESSION['dni'];


$queryalumno = "SELECT * FROM Alumno_Oferta WHERE DNI_CIF='$dni'";

if ($resultalumno = $conexion->query($queryalumno)) {
    while ($rowalumno = $resultalumno->fetch(PDO::FETCH_OBJ)) {
        $id_oferta= $rowalumno->Id_Oferta
    }
}

$queryoferta= "SELECT Oferta.Titulo,Oferta.Descripcion, Usuario.Nombre_Usuario FROM Oferta, Usuario WHERE Oferta.Activo = 1 AND Oferta.DNI_CIF='$dni' AND Id_Oferta=$id_oferta";

if ($resultoferta = $conexion->query($queryoferta)) {
    while ($rowoferta = $resultoferta->fetch(PDO::FETCH_OBJ)) {
        $titulo=$rowoferta->Titulo;
        $descripcion=$rowoferta->Descripcion;
        $nombre_usuario=$rowoferta->Nombre_Usuario

        echo $nombre_usuario;
        echo $titulo;
        echo $descripcion;
        
    }
}

?>
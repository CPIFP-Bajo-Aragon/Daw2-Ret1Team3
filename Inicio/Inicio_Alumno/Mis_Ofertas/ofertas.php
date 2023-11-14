<?php
include "/var/www/html/profitech/Funciones/conexion.php";
session_start();
$dni = $_SESSION['dni'];


$queryalumno = "SELECT * FROM Alumno_Oferta WHERE DNI_CIF='$dni'";
if ($resultalumno = $conexion->query($queryalumno)) {
    while ($rowalumno = $resultalumno->fetch(PDO::FETCH_OBJ)) {
        $id_oferta=$rowalumno->Id_Oferta;

    }
}

$queryoferta= "SELECT Oferta.Titulo,Oferta.Descripcion,Municipio.Nombre_Municipio,Usuario.Nombre_Usuario  FROM Alumno_Oferta, Municipio,Usuario,Empresa,Oferta
 WHERE Oferta.Id_Oferta=Alumno_Oferta.Id_Oferta 
 AND Alumno_Oferta.DNI_CIF=Empresa.DNI_CIF 
 AND Oferta.Id_Municipio=Municipio.Id_Municipio
 AND Empresa.DNI_CIF=Usuario.DNI_CIF
 AND Oferta.Activo = 1
 And Oferta.Id_Oferta= $id_oferta;
 

 


if ($resultoferta = $conexion->query($queryoferta)) {
    while ($rowoferta = $resultoferta->fetch(PDO::FETCH_OBJ)) {
        $titulo=$rowoferta->Titulo;
        $descripcion=$rowoferta->Descripcion;
        $nombre_municipio=$rowoferta->Nombre_Municipio;
        $nombre_usuario=$rowoferta->Nombre_Usuario;

        echo "<p>".$nombre_usuario."</p>";
        echo "<p>".$titulo."</p>";;
        echo "<p>".$descripcion."</p>";;
        echo "<p>".$nombre_municipio."</p>";;
        
    }
}

?>
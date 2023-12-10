<?php

include "../../Funciones/conexion.php";

$dni = $_SESSION['dni'];
$username = $_SESSION['Nombre_Usuario'];
if (!isset($_SESSION['dni'])) {
        header("Location: ../../index.php");
        exit();
}




// VARIABLES NECESARIAS PARA EL BORRADO

$Id_Oferta=$_POST['Id_Oferta'];

$Id_Borrado=2;
/*
if (!empty($Id_Oferta)){
        $Id_Oferta=$_POST['Id_Oferta'];
}
*/

$sql=$conexion->prepare("UPDATE Oferta SET Activo=? WHERE Id_Oferta=?");
$sql->bindParam(1,$Id_Borrado);
$sql->bindParam(2,$Id_Oferta);
if (isset($_POST['confirmacionEliminacion3'])=='true') {
$sql->execute();

        try {



/*
                // DE OFERTA HAY QUE BORRAR EN 6 TABLAS:

                // 1

                $queryborrar = "DELETE FROM `Oferta_Hard_Skill` WHERE Id_Oferta = $Id_Oferta";
                $conexion->query($queryborrar);


                // 2

                $queryborrar = "DELETE FROM `Oferta_Nivel_Idioma` WHERE Id_Oferta = $Id_Oferta";
                $conexion->query($queryborrar);


                // 3

                $queryborrar = "DELETE FROM `Oferta_Soft_Skill` WHERE Id_Oferta = $Id_Oferta";
                $conexion->query($queryborrar);


                // 4

                $queryborrar = "DELETE FROM `Oferta_Tipo_Titulacion` WHERE Id_Oferta = $Id_Oferta";
                $conexion->query($queryborrar);


                // 5

                $queryborrar = "DELETE FROM `Alumno_Oferta` WHERE Id_Oferta = $Id_Oferta";
                $conexion->query($queryborrar);


                // 6

                $queryborrar = "DELETE FROM `Oferta` WHERE Id_Oferta = $Id_Oferta";
                $conexion->query($queryborrar);

*/







                echo "Se ha borrado con exito";
                header("Location: ofertas.php");
        } catch (PDOException $e) {
                echo "Error al borrar la consulta";
                header("Location: ofertas.php");
        }
}

if (isset($_POST['borrarHardSkill'])) {


        try {

                $Id_Hard = $_POST['Id_Hard'];
           
                $queryborrar = "DELETE FROM Oferta_Hard_Skill WHERE Id_Oferta = $Id_Oferta AND Id_Hard= $Id_Hard";
               
                
                $conexion->query($queryborrar);


                echo "Se ha borrado con exito";
               header("Location: editarOferta.php?Id_Oferta=".$Id_Oferta);
        } catch (PDOException $e) {
                echo "Error al borrar la consulta";
                header("Location: editarOferta.php?Id_Oferta=".$Id_Oferta);
        }
}

if (isset($_POST['borrarIdioma'])) {


        try {

                $Id_Nivel = $_POST['Id_Nivel'];
                $Id_Idioma = $_POST['Id_Idioma'];

                $queryborrar = "DELETE FROM `Oferta_Nivel_Idioma` WHERE Id_Oferta = $Id_Oferta AND Id_Nivel= $Id_Nivel AND Id_Idioma = $Id_Idioma";
                $conexion->query($queryborrar);


                echo "Se ha borrado con exito";
                header("Location: editarOferta.php?Id_Oferta=" . $Id_Oferta);
        } catch (PDOException $e) {
                echo "Error al borrar la consulta";
                header("Location: editarOferta.php?Id_Oferta=" . $Id_Oferta);
        }
}

if (isset($_POST['borrarSoftSkill'])) {


        try {

                $Id_Soft = $_POST['Id_Soft'];

                $queryborrar = "DELETE FROM `Oferta_Soft_Skill` WHERE Id_Oferta = $Id_Oferta AND Id_Soft= $Id_Soft";
                $conexion->query($queryborrar);


                echo "Se ha borrado con exito";
                header("Location: editarOferta.php?Id_Oferta=" . $Id_Oferta);
        } catch (PDOException $e) {
                echo "Error al borrar la consulta";
                header("Location: editarOferta.php?Id_Oferta=" . $Id_Oferta);
        }
}

if (isset($_POST['borrarTitulacion'])) {


        try {

                $Id_Tipo_Titulacion = $_POST['Id_Tipo_Titulacion'];

                $queryborrar = "DELETE FROM `Oferta_Tipo_Titulacion` WHERE Id_Oferta = $Id_Oferta AND Id_Tipo_Titulacion= $Id_Tipo_Titulacion";
                $conexion->query($queryborrar);


                echo "Se ha borrado con exito";
                header("Location: editarOferta.php?Id_Oferta=" . $Id_Oferta);
        } catch (PDOException $e) {
                echo "Error al borrar la consulta";
                header("Location: editarOferta.php?Id_Oferta=" . $Id_Oferta);
        }
}
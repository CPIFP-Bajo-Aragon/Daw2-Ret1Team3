<?php
        include "../../Funciones/conexion.php";
session_start();
$dni = $_SESSION['dni'];
$sqluno="SELECT * FROM `Oferta` WHERE DNI_CIF='$dni' AND Activo=1";
if ($sqluno = $conexion->query($sql_carga_mensaje)) {
    while ($row = $sqluno->fetch(PDO::FETCH_OBJ)) {
        $Id_Oferta  = $row->Id_Oferta;
        $Titulo = $row->Titulo;
        $Vacantes  = $row->Vacantes;
        $Descripcion  = $row->Descripcion;

    }
}



$sqldos="SELECT * FROM Oferta_Hard_Skill, Hard_Skill WHERE ID_oferta='$Id_Oferta'";
$sqltres="SELECT * FROM `Oferta` WHERE DNI_CIF='$dni'";
$sqlcuatro="SELECT * FROM `Oferta` WHERE DNI_CIF='$dni'";

?>
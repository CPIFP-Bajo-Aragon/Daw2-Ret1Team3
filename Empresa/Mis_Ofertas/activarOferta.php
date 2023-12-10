<?php

include("../../Funciones/conexion.php");

if (isset($_POST['activarOferta'])) {

    try{
        $Id_Oferta = $_POST['idoferta'];

        $query = $conexion->prepare("UPDATE Oferta SET Activo = 1 WHERE Id_Oferta = $Id_Oferta");
    
        $query->execute();
    } catch(PDOException $e) {
        echo "Error al ejecutar la consulta: " . $e->getMessage();
    }

 

}

if (isset($_POST['desactivarOferta'])) {

    try{
        $Id_Oferta = $_POST['idoferta'];

        $query = $conexion->prepare("UPDATE Oferta SET Activo = 0 WHERE Id_Oferta = $Id_Oferta");
    
        $query->execute();
    
    } catch(PDOException $e) {
        echo "Error al ejecutar la consulta: " . $e->getMessage();
    }

   
}



header("Location: ofertas");
exit();
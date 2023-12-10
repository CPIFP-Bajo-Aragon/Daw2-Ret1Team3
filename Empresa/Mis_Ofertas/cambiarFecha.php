<?php
include "../../Funciones/conexion.php";

if (isset($_POST['anadirMes'])) {
    $Id_Oferta = $_POST['Id_Oferta'];
    $Fecha_Fin = $_POST['Fecha_Fin'];
 



    $sentencia = $conexion->prepare("UPDATE Oferta SET Fecha_Fin = DATE_ADD(Fecha_Fin, INTERVAL 1 MONTH) WHERE Id_Oferta = $Id_Oferta");

    try {
        $sentencia->execute();
        header("Location: editarOferta.php?Id_Oferta=" . $Id_Oferta);


    } catch (PDOException $e) {
        header("Location: editarOferta.php?Id_Oferta=" . $Id_Oferta);

    }
}


if (isset($_POST['quitarMes'])) {
    $Id_Oferta = $_POST['Id_Oferta'];
    $Fecha_Fin = $_POST['Fecha_Fin'];

    // Obtener la fecha de inicio
    $query = "SELECT Fecha_Inicio FROM Oferta WHERE Id_Oferta = $Id_Oferta";

    if ($resultado = $conexion->query($query)) {
        while ($rowResultado = $resultado->fetch(PDO::FETCH_OBJ)) {
            $Fecha_Inicio = $rowResultado->Fecha_Inicio;
        }
      
    }


    if (strtotime($Fecha_Fin) >= strtotime($Fecha_Inicio)) {
      
        // La fecha es válida, realizar la actualización
        $sentencia = $conexion->prepare("UPDATE Oferta SET Fecha_Fin = DATE_SUB(Fecha_Fin, INTERVAL 1 MONTH) WHERE Id_Oferta = $Id_Oferta");

        try {
            $sentencia->execute();
            header("Location: editarOferta.php?Id_Oferta=" . $Id_Oferta);
        } catch (PDOException $e) {
            echo "Error al ejecutar la consulta: " . $e->getMessage();
           
        }
    } else {
     
  
        $_SESSION['error_message'] = "Error: La fecha final no puede ser inferior a la fecha de inicio.";
        echo "Fecha final: $Fecha_Fin, Fecha inicio: $Fecha_Inicio";
        header("Location: editarOferta.php?Id_Oferta=" . $Id_Oferta); 
        exit(); 
    }
}

?>
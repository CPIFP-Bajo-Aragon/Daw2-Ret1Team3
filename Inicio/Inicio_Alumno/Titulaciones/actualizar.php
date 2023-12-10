
<?php include "../../../Funciones/conexion.php";?>
<?php
session_start();
include "../../Funciones/SessionStart.php";

$idCentro = !empty($_POST['centros']) ? $_POST['centros'] : null;
$idTipoTitulacion = !empty($_POST['titulos']) ? $_POST['titulos'] : null;
$dniCif = $_SESSION['dni'];
$fInicio = !empty($_POST['Fecha_Inicio']) ? $_POST['Fecha_Inicio'] : null;
$fFin = !empty($_POST['Fecha_Fin']) ? $_POST['Fecha_Fin'] : null;

try {


    $query = "INSERT INTO Titulacion_Centro_Persona (Id_Centro, Id_Tipo_Titulacion, DNI_CIF, Fecha_Inicio, Fecha_Fin) VALUES (:idCentro, :idTipoTitulacion, :dniCif, :fInicio, :fFin)";
    $stmt = $conexion->prepare($query);
    $stmt->bindParam(':idCentro', $idCentro);
    $stmt->bindParam(':idTipoTitulacion', $idTipoTitulacion);
    $stmt->bindParam(':dniCif', $dniCif);
    $stmt->bindParam(':fInicio', $fInicio);
    $stmt->bindParam(':fFin', $fFin);

    
    if($FInicio>$Fin ){
        echo "<script>";
        echo "alert('la fecha fin no puede ser menor que la fecha inicio')";
        echo "</script>";
        echo "<script>";
        echo "location.replace('../index.php#titulaciones')";
        echo "</script>";
    }else{
        $stmt->execute();


        header("Location: ../index.php#titulaciones");
    }


   
} catch (PDOException $e) {
    echo "Error en la base de datos: " . $e->getMessage();
}


?>


<?php 
include "../../../Funciones/conexion.php";

session_start();
$dni = $_SESSION['dni'];
$Soft_Skill = $_POST['Soft_Skill'];


$sentencia = $conexion->prepare("INSERT INTO Soft_Skill_Alumno (Id_Soft, DNI_CIF) VALUES (?, ?)");
$sentencia->bindParam(1, $Soft_Skill);
$sentencia->bindParam(2, $dni);

 


 try {
    $sentencia->execute();
    header("Location: ../index.php#habper");


} catch (PDOException $e) {
    echo "Error al actualizar la consulta ";
    header("Location: ../index.php#habper");
}



?>

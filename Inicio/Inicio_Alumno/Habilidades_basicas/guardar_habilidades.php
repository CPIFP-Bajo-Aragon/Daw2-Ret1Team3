
<?php 
include "../../../Funciones/conexion.php";

session_start();
$dni = $_SESSION['dni'];
$Hard_Skill = $_POST['Hard_Skill'];


$sentencia = $conexion->prepare("INSERT INTO Hard_Skill_Alumno (Id_Hard, DNI_CIF) VALUES (?, ?)");
$sentencia->bindParam(1, $Hard_Skill);
$sentencia->bindParam(2, $dni);

 


 try {
    $sentencia->execute();
    header("Location: ../index.php#habbas");


} catch (PDOException $e) {
    echo "Error al actualizar la consulta ";
    header("Location: ../index.php#habbas");

    
}



?>

<?php include "../../../Funciones/conexion.php";?>
<?php
?>
<?php
$dni=$_SESSION['dni'];
$nombreAdmin = !empty($_POST['nombreAdmin']) ? $_POST['nombreAdmin'] : null;
$apellidoAdmin = !empty($_POST['apellidoAdmin']) ? $_POST['apellidoAdmin'] : null;



$sql = "UPDATE Usuario
SET Nombre_Usuario = ?
WHERE DNI_CIF = ?";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(1, $nombreAdmin);
$stmt->bindParam(2, $dni);

$sql2 = "UPDATE bolsa_emplea.Admin
SET Apellido = ?
WHERE DNI_CIF = ?";
$stmt2 = $conexion->prepare($sql2);
$stmt2->bindParam(1, $apellidoAdmin);
$stmt2->bindParam(2, $dni);

try{
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagen"])) {
        $uploadDirectory = "FotosAdmins/";
    
        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }
        
        $targetFile = $uploadDirectory . $dni . ".png";
        
        if (file_exists($targetFile) && empty($_FILES["imagen"])) {
            unlink($targetFile);
        }
    
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $targetFile)) {
            echo "Imagen subida con éxito.";
        } else {
            echo "Error al subir la imagen.";
        }
    }
    $stmt->execute();
    $stmt2->execute();
    header("Location: ../index.php");
    
}catch(PDOException $e){
    echo "error";
}





?>

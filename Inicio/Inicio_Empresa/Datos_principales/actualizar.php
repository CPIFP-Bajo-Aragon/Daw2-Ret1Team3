
<?php include "../../../Funciones/conexion.php";?>
<?php
session_start();

$dni = $_SESSION['dni'];
$Empresa = !empty($_POST['Empresa']) ? $_POST['Empresa'] : null;
$DNI_CIF = !empty($_POST['DNI_CIF']) ? $_POST['DNI_CIF'] : null;
$Web = !empty($_POST['Web']) ? $_POST['Web'] : null;
$Numero_Trabajadores = !empty($_POST['Numero_Trabajadores']) ? $_POST['Numero_Trabajadores'] : null;
$Direccion = $_POST['Direccion'];
$Area_Negocio = !empty($_POST['Area_Negocio']) ? $_POST['Area_Negocio'] : null;
$Telefono = $_POST['Telefono'];
$Pais = $_POST['Pais'];
$Descripcion = $_POST['Descripcion'];
$Nombre_Municipio = $_POST['Nombre_Municipio'];

try {

    $query = "UPDATE Usuario SET Nombre_Usuario = :Empresa WHERE DNI_CIF = :dni";
    $stmt = $conexion->prepare($query);
    $stmt->bindParam(':Empresa', $Empresa);
    $stmt->bindParam(':dni', $dni);
    $stmt->execute();

    $query = "UPDATE Empresa SET Empresa.Numero_Trabajadores = :Numero_Trabajadores, Empresa.Web = :Web, Empresa.Telefono = :Telefono, Empresa.Area_Negocio = :Area_Negocio, Empresa.Descripcion = :Descripcion, Empresa.Direccion = :Direccion, Empresa.Pais = :Pais, Empresa.Activo = :Activo WHERE DNI_CIF = :DNI_CIF";
    $stmt = $conexion->prepare($query);
    $stmt->bindParam(':Numero_Trabajadores', $Numero_Trabajadores);
    $stmt->bindParam(':Web', $Web);
    $stmt->bindParam(':Telefono', $Telefono);
    $stmt->bindParam(':Area_Negocio', $Area_Negocio);
    $stmt->bindParam(':Descripcion', $Descripcion);
    $stmt->bindParam(':Direccion', $Direccion);
    $stmt->bindParam(':Pais', $Pais);
    $stmt->bindParam(':Activo', $Activo);
    $stmt->bindParam(':DNI_CIF', $DNI_CIF);
    $stmt->bindParam(':Activo', $Activo);
    $stmt->execute();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagen"])) {
        $uploadDirectory = "FotosAlumnos/";

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
    



   header('Location: ../');
} catch (PDOException $e) {
    echo "Error en la base de datos: " . $e->getMessage();
}


?>
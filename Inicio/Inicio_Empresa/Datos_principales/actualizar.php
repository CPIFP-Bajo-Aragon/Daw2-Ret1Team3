
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
    $stmt->bindParam(':Empresa', $nombre);
    $stmt->bindParam(':dni', $dni);
    $stmt->execute();

    $query = "UPDATE Alumno SET Apellido = :apellido, Fecha_Nacimiento = :fechaNacimiento, Telefono_Alumno = :telefonoAlumno, Movilidad = :movilidad, Direccion = :direccion, Perfil_Publico = :perfilPublico, Id_Municipio = :idMunicipio WHERE DNI_CIF = :dni";
    $stmt = $conexion->prepare($query);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':fechaNacimiento', $fechaNacimiento);
    $stmt->bindParam(':telefonoAlumno', $telefonoAlumno);
    $stmt->bindParam(':movilidad', $movilidad);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':perfilPublico', $perfilPublico);
    $stmt->bindParam(':idMunicipio', $idMunicipio);
    $stmt->bindParam(':dni', $dni);
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
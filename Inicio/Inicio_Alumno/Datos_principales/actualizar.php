
<?php include "../../../Funciones/conexion.php";?>
<?php
session_start();

$dni = $_SESSION['dni'];
$nombre = !empty($_POST['Nombre']) ? $_POST['Nombre'] : null;
$apellido = !empty($_POST['Apellido']) ? $_POST['Apellido'] : null;
$fechaNacimiento = !empty($_POST['Fecha_Nacimiento']) ? $_POST['Fecha_Nacimiento'] : null;
$telefonoAlumno = !empty($_POST['Telefono_Alumno']) ? $_POST['Telefono_Alumno'] : null;
$movilidad = $_POST['Movilidad'];
$direccion = !empty($_POST['Direccion']) ? $_POST['Direccion'] : null;
$perfilPublico = $_POST['Perfil_Publico'];
$idMunicipio = $_POST['municipios'];

try {

    $query = "UPDATE Usuario SET Nombre_Usuario = :nombre WHERE DNI_CIF = :dni";
    $stmt = $conexion->prepare($query);
    $stmt->bindParam(':nombre', $nombre);
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
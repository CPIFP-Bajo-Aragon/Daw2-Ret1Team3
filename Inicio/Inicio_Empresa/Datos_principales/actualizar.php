<?php include "../../../Funciones/conexion.php";?>

<?php
// $dni = $_SESSION['dni'];
// $nombre = $_POST['nombre'];
// $ntrabajadores = $_POST['ntrabajadores'];
// $web = $_POST['web'];
// $telefono = $_POST['telefono'];
// $direccion = $_POST['direccion'];
// $descripcion = $_POST['descripcion'];
// $municipio = $_POST['municipios'];
// $id_pais = $_POST['pais'];
// $Area = $_POST['area'];

$nombre = !empty($_POST['nombre']) ? $_POST['nombre'] : null;
$ntrabajadores = !empty($_POST['ntrabajadores']) ? $_POST['ntrabajadores'] : null;
$web = !empty($_POST['web']) ? $_POST['web'] : null;
$telefono = !empty($_POST['telefono']) ? $_POST['telefono'] : null;
$direccion = !empty($_POST['direccion']) ? $_POST['direccion'] : null;
$descripcion = !empty($_POST['descripcion']) ? $_POST['descripcion'] : null;
$municipio = !empty($_POST['municipios']) ? $_POST['municipios'] : null;
$id_pais = !empty($_POST['pais']) ? $_POST['pais'] : null;
$Area = !empty($_POST['area']) ? $_POST['area'] : null;

//Si ESPAÑA no es elegido poner 8123
if($id_pais!=73){
    $municipio=8123;
}

try{
    $sql = "UPDATE Usuario
    SET Nombre_Usuario = ?
    WHERE DNI_CIF = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(1, $nombre);
    $stmt->bindParam(2, $dni);
    $stmt->execute();

    $sql = "UPDATE Empresa
    SET Numero_Trabajadores = ?, Web = ?, Telefono = ?, Descripcion = ?, Direccion = ?, Id_Municipio = ?, Pais = ?, Area_Negocio = ?
    WHERE DNI_CIF = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(1, $ntrabajadores);
    $stmt->bindParam(2, $web);
    $stmt->bindParam(3, $telefono);
    $stmt->bindParam(4, $descripcion);
    $stmt->bindParam(5, $direccion);
    $stmt->bindParam(6, $municipio);
    $stmt->bindParam(7, $id_pais);
    $stmt->bindParam(8, $Area);
    $stmt->bindParam(9, $dni);
    $stmt->execute();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagen"])) {
        $uploadDirectory = "FotosEmpresa/";

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

}catch (PDOException $e) {
    echo "Error en la base de datos: " . $e->getMessage();
}
?>
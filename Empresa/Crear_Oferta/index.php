<?php
        include "../../Funciones/conexion.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = $_SESSION['dni'];
    $id_oferta = $_POST['id_oferta'];
    $titulo = $_POST['titulo'];
    $vacantes = $_POST['vacantes'];
    $descripcion = $_POST['descripcion'];
    $activo = $_POST['activo'];
    $fecha_publicacion = $_POST['fecha_publicacion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $dni_cif = $dni;
    $id_municipio = $_POST['id_municipio'];


    try {
        $pdo = new PDO("mysql:host=nombre_del_servidor;dbname=bolsa_emplea", "nombre_de_usuario", "contraseña");

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO nombre_de_la_tabla (dni, id_oferta, titulo, vacantes, descripcion, activo, fecha_publicacion, fecha_inicio, fecha_fin, dni_cif, id_municipio)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([$dni, $id_oferta, $titulo, $vacantes, $descripcion, $activo, $fecha_publicacion, $fecha_inicio, $fecha_fin, $dni_cif, $id_municipio]);

        echo "Datos insertados correctamente.";
    } catch (PDOException $e) {
        echo "Error al insertar datos: " . $e->getMessage();
    } finally {
        $pdo = null;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Inserción de Datos</title>
</head>
<body>
  <h2>Formulario de Inserción de Datos</h2>

  <form action="" method="post">
    <!-- Datos a insertar -->
    <label for="id_oferta">Id_Oferta:</label>
    <input type="text" name="id_oferta" required>

    <label for="titulo">Titulo:</label>
    <input type="text" name="titulo" required>

    <label for="vacantes">Vacantes:</label>
    <input type="number" name="vacantes" required>

    <label for="descripcion">Descripcion:</label>
    <textarea name="descripcion" required></textarea>

    <label for="activo">Activo:</label>
    <input type="number" name="activo" required>

    <label for="fecha_publicacion">Fecha_Publicacion:</label>
    <input type="date" name="fecha_publicacion" required>

    <label for="fecha_inicio">Fecha_Inicio:</label>
    <input type="date" name="fecha_inicio" required>

    <label for="fecha_fin">Fecha_Fin:</label>
    <input type="date" name="fecha_fin" required>

    <input type="hidden" name="dni" value="<?php echo $dni; ?>">


    <!-- Arreglar -->

    <label for="id_municipio">Id_Municipio:</label>
    <input type="number" name="id_municipio" required>

    <input type="submit" value="Insertar Datos">
  </form>
</body>
</html>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Nuevo Administrador</title>
</head>

<body>

    <h2>Añadir Nuevo Administrador</h2>

    <form action="index.php" method="post">
        <label for="dni">DNI/CIF:</label>
        <input type="text" id="dni" name="dni" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="nombre">Apellido:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="clave">Contraseña:</label>
        <input type="password" id="clave" name="clave" required><br>


        <label for="clave">Repetir Contraseña:</label>
        <input type="password" id="clave" name="clave" required><br>


        <input type="submit" value="Añadir Administrador">
    </form>
</body>

</html>
<?php 
include "../../Funciones/conexion.php";

   if($_SESSION['Tipo_Usuario']=='Alumno'){
        session_abort();
        session_destroy();
        header("Location: /");
        exit;
    }else if($_SESSION['Tipo_Usuario']=='Empresa'){
        session_abort();
        session_destroy();
        header("Location: /");
        exit;
    }
?>
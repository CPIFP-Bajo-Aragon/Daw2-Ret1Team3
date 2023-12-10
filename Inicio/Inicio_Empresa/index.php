<link rel="shortcut icon" href="../../../Imagenes/icon/icon.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<?php
include "../../Funciones/conexion.php";
$dni = $_SESSION['dni'];
$username = $_SESSION['Nombre_Usuario'];
$_SESSION["dni_usuario_mensaje"] = $dni;

if (!isset($_SESSION['dni'])) {
    header("Location: ../../index");
    exit();

}
if($_SESSION['Tipo_Usuario']=='Alumno'){
    session_abort();
    header("Location: /");
    exit;
}else if($_SESSION['Tipo_Usuario']=='Admin'){
    session_abort();
    header("Location: /");
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">

<?php

function cerrarSesion()
{
    session_destroy();
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../Estilos/alumno.css">
</head>

<body>
    <main>

        <?php include "../../Header/CabeceraLogeado.php"; ?>
        <div class="main-content">
            <?php include "../../menuLateral/Empresa/menuEmpresa.php"; ?>
            <section class="main-info">
                <div class="breadcrumbs">
                    <h1 id="breadcrumbs-title">Empresa / <span>Inicio</span></h1>
                    <div class="breadcrumb-dropdown enlace-caja">
                        <ul>
                            <li></li>
                            <li><a href="#datosPrincipales">Datos principales</a></li>
                            <li><a href="#titulaciones">Titulaciones</a></li>
                            <li><a href="#formacionComplementaria">Formación complementaria</a></li>
                            <li><a href="#experiencia">Experiencia</a></li>
                            <li><a href="#habilidadesPersonales">Habilidades personales</a></li>
                            <li><a href="#habilidadesBasicas">Habilidades básicas</a></li>
                            <li><a href="#idiomas">Idiomas</a></li>
                        </ul>
                    </div>
                </div>
                <article class="card">
                    <h2 class="card-title">Datos principales</h2>
                    <hr class="hr-divider">
                    <div class="cardContent">
                        <div id="imageContainer">
                            <div class="divImagenAlumno">
                                <?php
                                    $rutaImagen = "./Datos_principales/FotosEmpresa/" . $dni . ".png";
                                    
                                    // Verificar si la imagen existe
                                    if (file_exists($rutaImagen)) {
                                        // Mostrar la imagen del alumno
                                        echo '<img class="imagenAlumno" alt="Imagen del alumno" src="' . $rutaImagen . '">';
                                    } else {
                                        // Mostrar la imagen por defecto
                                        echo '<img class="imagenAlumno" alt="Imagen del alumno" src="./Datos_principales/FotosEmpresa/default.png">';
                                    }
                                ?>
                            </div>
                        </div>
                        <div id="datosPrincipales">
                            <?php include "Datos_principales/inicio_Empresa.php"?>
                        </div>
                    </div>
                </article>

            </section>
        </div>
        <div class="footer">
            <?php include "../../Footer/footer.php"; ?>
        </div>
    </main>
</body>

</html>
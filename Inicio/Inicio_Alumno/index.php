<link rel="shortcut icon" href="../../../Imagenes/icon/icon.png">
<!DOCTYPE html>
<html lang="es">

<?php
session_start();
$dni = $_SESSION['dni'];
$username = $_SESSION['Nombre_Usuario'];

if($_SESSION['Tipo_Usuario']=='Empresa'){
    session_abort();
    header("Location: /");
    exit;
}else if($_SESSION['Tipo_Usuario']=='Admin'){
    session_abort();
    header("Location: /");
    exit;
}

function cerrarSesion()
{
    session_destroy();
}
$_SESSION["dni_usuario_mensaje"] = $dni;

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Alumno</title>
    <script src="../../Funciones/breadcrumbs.js"></script>
    <script src="../../Funciones/minimizeCards.js"></script>
    <!-- PARTE DEL SELECT 2 -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Incluir jQuery desde CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <!-- Mi script -->
    <script src="../../Funciones/select2.js"></script>


</head>

<body>



    <main>
        <?php    include "../../Funciones/conexion.php"; ?>
        <?php include "../../Header/CabeceraLogeado.php"; ?>


        <link rel="stylesheet" href="../../Estilos/alumno.css">
        <div id="modal-container"></div>
        <div class="main-content">
            <?php include "../../menuLateral/Alumno/menuAlumno.php"; ?>
            <section class="main-info">

                <div class="breadcrumbs">
                    <h1 id="breadcrumbs-title">Alumno / <span>Inicio</span></h1>
                    <div class="breadcrumb-dropdown enlace-caja">
                        <ul>
                            <li></li>
                            <li><a href="#datosPrincipales">Datos principales</a></li>
                            <li><a href="#titulaciones">Titulaciones</a></li>
                            <li><a href="#formacionComplementaria">Formación complementaria</a></li>
                            <li><a href="#experiencia">Experiencia Laboral</a></li>
                            <li><a href="#habilidadesPersonales">Habilidades personales</a></li>
                            <li><a href="#habilidadesBasicas">Habilidades básicas</a></li>
                            <li><a href="#idiomas">Idiomas</a></li>
                        </ul>
                    </div>
                </div>

                <article id="datosPrincipales" class="card">
                    <div class="card-header">
                        <span class="arrow">&#9654;</span>
                        <h2 class="card-title">Datos principales</h2>
                    </div>
                    <hr class="hr-divider">
                    <div class="cardContent">
                        <div id="imageContainer">
                            <div class="divImagenAlumno">
                                <?php
                                    $rutaImagen = "./Datos_principales/FotosAlumnos/" . $dni . ".png";
                                    
                                    // Verificar si la imagen existe
                                    if (file_exists($rutaImagen)) {
                                        // Mostrar la imagen del alumno
                                        echo '<img class="imagenAlumno" alt="Imagen del alumno" src="' . $rutaImagen . '">';
                                    } else {
                                        // Mostrar la imagen por defecto
                                        echo '<img class="imagenAlumno" alt="Imagen del alumno" src="./Datos_principales/FotosAlumnos/default.png">';
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="datosPrincipalesContent">
                            <?php include "Datos_principales/inicio_Alumno.php"; ?>
                        </div>
                    </div>
                </article>

                <article id="titulaciones" class="card">
                    <div class="card-header">
                        <span class="arrow">&#9654;</span>
                        <h2 class="card-title">Titulaciones de FP:</h2>
                    </div>
                    <hr class="hr-divider">
                    <div class="cardContent">
                        <div class="cardInfo">


                            <button onclick="openModalTitulacion()">Agregar Titulación</button>

                            <?php include "Titulaciones/ver_Alumno.php" ?>
                        </div>
                    </div>
                </article>



                <article id="formacionComplementaria" class="card">
                    <div class="card-header">
                        <span class="arrow">&#9654;</span>
                        <h2 class="card-title" id="Formacion_complementaria">Formación complementaria</h2>
                    </div>
                    <hr class="hr-divider">
                    <div class="cardContent">
                        <div class="cardInfo">



                            <button onclick="openModalFormacion()">Agregar Formación</button>

                            <?php include "Formacion_Complementaria/Formacion_Complementaria_Alumno.php" ?>
                        </div>
                </article>

                <article class="card" id="experiencia">
                    <div class="card-header">
                        <span class="arrow">&#9654;</span>
                        <h2 class="card-title">Experiencia laboral</h2>
                    </div>
                    <hr class="hr-divider">
                    <div class="cardContent">
                        <div class="cardInfo">
                            <button onclick="openModalExperiencia()">Agregar experiencia</button>
                            <?php include "Experiencia_Laboral/experiencialaboral.php" ?>
                        </div>
                    </div>
                </article>

                <article class="card" id="habilidadesPersonales">
                    <div class="card-header">
                        <span class="arrow">&#9654;</span>
                        <h2 class="card-title">Habilidades personales</h2>
                    </div>
                    <hr class="hr-divider">
                    <div class="cardContent">
                        <div class="cardInfo">
                            <!-- <button onclick="openModalHabilidadesPersonales()">Agregar habilidades personales</button> -->
                            <?php include "Habilidades_personales/habilidades_personales.php" ?>
                        </div>
                    </div>
                </article>

                <article class="card" id="habilidadesBasicas">
                    <div class="card-header">
                        <span class="arrow">&#9654;</span>
                        <h2 class="card-title">Habilidades básicas</h2>
                    </div>
                    <hr class="hr-divider">
                    <div class="cardContent">
                        <div class="cardInfo">
                            <!-- <button onclick="openModalHabilidadesBasicas()">Agregar habilidades básicas</button> -->
                            <?php include "Habilidades_basicas/habilidades_basicas.php" ?>
                        </div>
                    </div>
                </article>

                <article class="card" id="idiomas">
                    <div class="card-header">
                        <span class="arrow">&#9654;</span>
                        <h2 class="card-title">Idiomas</h2>
                    </div>
                    <hr class="hr-divider">
                    <div class="cardContent">
                        <div class="cardInfo">


                            <button onclick="openModalIdioma()">Agregar Idioma</button>
                            <?php include "Idioma/Idioma.php" ?>
                        </div>
                    </div>

                </article>

            </section>
        </div>
        <div class="footer">
            <?php include "../../Footer/footer.php"; ?>
        </div>
    </main>

    <script src="../../Funciones/ventanaModal.js"></script>

</body>


</html>
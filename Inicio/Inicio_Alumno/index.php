<link rel="shortcut icon" href="../../../Imagenes/icon/icon.png">
<!DOCTYPE html>
<html lang="es">

<?php
session_start();
$dni = $_SESSION['dni'];
$username = $_SESSION['Nombre_Usuario'];

function cerrarSesion()
{
    session_destroy();
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../../Funciones/breadcrumbs.js"></script>
    <script src="../../Funciones/minimizeCards.js"></script>
</head>

<body>



    <main>

        <?php include "../../Header/CabeceraLogeado.php"; ?>
        <link rel="stylesheet" href="../../Estilos/alumno.css">
        <div class="main-content">
            <nav class="main-menu">
                <ul>
                    <a href="#">
                    <li id="Inicio"><i class="fa fa-car"></i> Inicio</li>
                    </a>
                    <a href="../../Alumno/Curriculum/curriculum.php">
                        <li>Curriculum</li>
                    </a>
                    <a href="../../Alumno/Alertas/index.php">
                        <li>Mis alertas</li>
                    </a>
                    <a href="../../Alumno/Mensajes/mensaje.php">
                        <li>Mensajes</li>
                    </a>
                    <a href="../../Alumno/Mis_Ofertas/ofertas.php">
                        <li>Mis ofertas</li>
                    </a>
                    <hr>
                    <a href="../../Alumno/Buscar_Empresas/index.php">
                        <li>Buscar empresas</li>
                    </a>
                    <a href="../../Alumno/Buscar_Ofertas/index.php">
                        <li>Buscar ofertas</li>
                    </a>
                    <hr>
                    <a href="../../Cambiar_Clave/Alumno/Cambiar_Clave_Alumno.php">
                        <li>Cambiar contraseña</li>
                    </a>

                </ul>
            </nav>
            <section class="main-info">

                <div class="breadcrumbs">
                    <h1 id="breadcrumbs-title">Alumno / <span>Inicio</span></h1>
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

                <article id="datosPrincipales" class="card">
                    <div class="card-header">
                        <span class="arrow">&#9654;</span>
                        <h2 class="card-title">Datos principales</h2>
                    </div>
                    <hr class="hr-divider">
                    <div class="cardContent">
                        <div id="imageContainer">
                            <div class="divImagenAlumno">
                                <img class="imagenAlumno" alt="Imagen del alumno"
                                    src="<?php echo "./Datos_principales/FotosAlumnos/" . $dni . ".png"; ?>">
                                <!-- AQUÍ EL INCLUDE DE LA IMAGEN -->
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
                        <h2 class="card-title">Titulaciones</h2>
                    </div>
                    <hr class="hr-divider">
                    <div class="cardContent">
                        <div class="cardInfo">
                            <?php include "Titulaciones/Inicio_Alumno.php" ?>
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
                            <?php include "Formacion_Complementaria/Formacion_Complementaria_Alumno.php" ?>
                        </div>
                    </div>
                </article>

                <article class="card" id="experiencia">
                    <div class="card-header">
                        <span class="arrow">&#9654;</span>
                        <h2 class="card-title">Experiencia</h2>
                    </div>
                    <hr class="hr-divider">
                    <div class="cardContent">
                        <div class="cardInfo">
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
</body>


</html>
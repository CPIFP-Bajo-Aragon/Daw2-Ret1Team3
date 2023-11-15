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


</head>

<body>



    <main>

        <?php include "../../Header/CabeceraLogeado.php"; ?>
        <link rel="stylesheet" href="../../Estilos/alumno.css">
        <div class="main-content">
            <nav class="main-menu">
                <ul>
                    <a href="#">
                        <li id="Inicio">Inicio</li>
                    </a>
                    <a href="../../Alumno/Curriculum/curriculum.php">
                        <li>Curriculum</li>
                    </a>
                    <a href="../../Alumno/Alertas/index.php">
                        <li>Mis alertas</li>
                    </a>
                    <a href="#">
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
                    <div class="breadcrumb-dropdown">
                        <ul>
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
        <h2 class="card-title">Idioma</h2>
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
            <?php include "../footer/footer.php"; ?>
        </div>
    </main>
</body>

<script>

    /* JS BREADCRUM LISTA */

    document.addEventListener("DOMContentLoaded", function () {
        var breadcrumbs = document.querySelector(".breadcrumbs");
        var dropdown = document.querySelector(".breadcrumb-dropdown");

        breadcrumbs.addEventListener("click", function () {
            dropdown.style.display = dropdown.style.display === "none" ? "block" : "none";
            breadcrumbs.classList.toggle("open", dropdown.style.display === "block");
        });

        // Cerrar la lista desplegable si se hace clic fuera de ella
        document.addEventListener("click", function (event) {
            if (!breadcrumbs.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.style.display = "none";
                breadcrumbs.classList.remove("open");
            }
        });

        // Manejar clic en enlaces del menú
        document.querySelectorAll(".breadcrumb-dropdown a").forEach(function (link) {
            link.addEventListener("click", function (event) {
                event.preventDefault(); // Evita la navegación normal
                var targetId = link.getAttribute("href").substring(1); // Elimina el "#" del href
                scrollToSection(targetId);
                // Cierra el menú después de hacer clic en un enlace
                dropdown.style.display = "none";
                breadcrumbs.classList.remove("open");
            });
        });

        // Función para desplazarse a la sección
        function scrollToSection(sectionId) {
            var targetSection = document.getElementById(sectionId);
            if (targetSection) {
                var offset = breadcrumbs.clientHeight + 60; // Ajusta el valor según tus necesidades
                window.scrollTo({
                    top: targetSection.offsetTop - offset,
                    behavior: "smooth"
                });
            }
        }
    });

    /* MINIMIZAR LA CARD  */

    document.addEventListener("DOMContentLoaded", function () {
  var cardHeaders = document.querySelectorAll(".card-header");

  cardHeaders.forEach(function (header) {
    var arrow = header.querySelector(".arrow");
    var cardContent = header.parentElement.querySelector(".cardContent");

    // Establece la rotación inicial hacia abajo
    arrow.style.transform = "rotate(90deg)";

    header.addEventListener("click", function () {
      cardContent.classList.toggle("minimized");
      arrow.style.transform = cardContent.classList.contains("minimized") ? "rotate(0deg)" : "rotate(90deg)";
    });
  });
});








</script>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php include "../../Funciones/conexion.php"; ?>
    <?php
     $_SESSION["dni_usuario_mensaje"] = $dni;   
    $dni = $_SESSION['dni'];
    $username = $_SESSION['Nombre_Usuario'];

    function cerrarSesion(){
    session_destroy();
    }
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
</head>

<body>
    <?php
   
    if($_SESSION['Tipo_Usuario']!='Admin'){
        //echo "Acceso no permitido";
         header("Location: ../PermisoDenegado.php"); 
    }else{
    }
    ?>



    <main>
        <?php include "../../Header/CabeceraLogeado.php"; ?>


        <link rel="stylesheet" href="../../Estilos/alumno.css">
        <div class="main-content">
            <?php include "../../menuLateral/Admin/menuAdmin.php"; ?>
            <section class="main-info">

                <div class="breadcrumbs">
                    <h1 id="breadcrumbs-title">Admin / <span>Inicio</span></h1>
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
                                <?php
                                    $rutaImagen = "./Datos_principales/FotosAdmins/" . $dni . ".png";
                                    
                                    // Verificar si la imagen existe
                                    if (file_exists($rutaImagen)) {
                                        
                                        // Mostrar la imagen del alumno
                                        echo '<img class="imagenAlumno" alt="Imagen del alumno" src="' . $rutaImagen . '">';
                                    } else {
                                        // Mostrar la imagen por defecto
                                        echo '<img class="imagenAlumno" alt="Imagen del alumno" src="./Datos_principales/FotosAdmins/default.png">';
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="datosPrincipalesContent">
                            <?php include "Datos_principales/inicio_Admin.php"; ?>
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
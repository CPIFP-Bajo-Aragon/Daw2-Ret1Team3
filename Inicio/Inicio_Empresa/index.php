<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Inicio_Alumno/alumno.css">

    <?php
        session_start();
        $dni = $_SESSION['dni'];
        $username = $_SESSION['Nombre_Usuario'];

        function cerrarSesion(){
            session_destroy();
        }

    ?>
</head>
<body>
    <?php
   
    if($_SESSION['Tipo_Usuario']!='Empresa'){
        //echo "Acceso no permitido";
         header("Location: ../PermisoDenegado.php"); 
    }else{
        echo "Acceso permitido";
    }
    ?>
    <h1>PAGINA WEB DE EMPRESA!</h1>
    
    <?php
        echo $_SESSION['dni'];
        echo "<a href=\"../login.php\">Ir a inicio</a>";
    ?>

<main>
        <header class="main-header">
            <img src="../../Imagenes/Profitech.png" alt="">
            <div class="conInfo"><p>Hola, <?php echo $username ?></p>
            <form action="cerrarSesion.php" method="post">
            <input type="submit" value="Cerrar sesión"/>
            </form>
            </div>
        </header>
        <div class="main-content">
            <nav class="main-menu">
                <ul>
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#">Mis alertas</li>
                    <li><a href="#">Mensajes</a></li>
                    <li><a href="#">Mis ofertas</a></li>
                    <hr>
                    <li><a href="#">Buscar candidatos</a></li>
                    <hr>
                    <li><a href="#">Cambiar contraseña</a></li>
                    <li><a href="#">Cerrar sesión</a></li>
                </ul>
            </nav>
            <section class="main-info">

                <h1>Inicio</h1>
                <article class="card">
                    <h2 class="card-title">Datos principales</h2>
                        <hr class="hr-divider">
                    <div class="cardContent">
                        <div id="imageContainer">
                            <div class="divImagenAlumno">
                                <img class="imagenAlumno" alt="Imagen del alumno" src="<?php echo "./Datos_principales/FotosAlumnos/".$dni.".png"?>">
                                <img class="imagenUE" alt="Imagen del alumno" src="<?php echo "./Datos_principales/FotosAlumnos/".$dni.".png"?>">

                            </div>
                        </div>
                            <div id="datosPrincipales">
                                <?php include "Datos_principales/inicio_Alumno.php"?>
                            </div>
                    </div>
                </article>

                <article class="card">
                    <h2 class="card-title">Titulaciones</h2>
                        <hr class="hr-divider">
                    <div class="cardContent">
                        <div class="cardInfo">
                        <?php include "Titulaciones/Inicio_Alumno.php"?>
                        <?php include "Titulaciones/ver_Alumno.php"?>
                        </div>
                    </div>
                </article>

                <article class="card">
                    <h2 class="card-title" id="Formacion_complementaria">Formación complementaria</h2>
                    <hr class="hr-divider">
                    <div class="cardContent">
                        <div class="cardInfo">
                    <?php include "Formacion_Complementaria/Formacion_Complementaria_Alumno.php"?>
                        </div>
                    </div>
                </article>
                
                <article class="card" id="Experiencia_Laboral">
                    <h2 class="card-title">Experiencia</h2>
                    <hr class="hr-divider">
                    <div class="cardContent">
                        <div class="cardInfo">
                    <?php include "Experiencia_Laboral/experiencialaboral.php"?>
                        </div>
                    </div>
                </article>

                <article class="card"  id="habper"> 
                    <h2 class="card-title">Habilidades personales</h2>
                    <hr class="hr-divider">
                    <div class="cardContent">
                        <div class="cardInfo">
                    <?php include "Habilidades_personales/habilidades_personales.php"?>
                        </div>
                    </div>
                </article>
    
                <article class="card"  id="habbas">
                    <h2 class="card-title">Habilidades básicas</h2>
                    <hr class="hr-divider">
                    <div class="cardContent">
                        <div class="cardInfo">
                        <?php include "Habilidades_basicas/habilidades_basicas.php"?>
                        </div>
                    </div>
                </article>


                <article class="card" id="Idioma">
                    <h2 class="card-title">Idioma</h2>
                    <hr class="hr-divider">
                    <div class="cardContent">
                        <div class="cardInfo">
                        <?php include "Idioma/Idioma.php"?>
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
</html>
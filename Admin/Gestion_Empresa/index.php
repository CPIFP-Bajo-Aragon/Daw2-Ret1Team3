<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Document</title>

    <?php include "../../Funciones/conexion.php"; ?>
    <?php
        
    $dni = $_SESSION['dni'];
    $username = $_SESSION['Nombre_Usuario'];

    function cerrarSesion(){
    session_destroy();
    }

    ?>
</head>

<body>
    <?php
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
    if($_SESSION['Tipo_Usuario']!='Admin'){
        //echo "Acceso no permitido";
         header("Location: ../PermisoDenegado.php"); 
    }else{
       
    }
    ?>


    <?php
       
        echo "<a href=\"../login.php\">Ir a inicio</a>";
    ?>

    <main>
        <?php include "../../Header/CabeceraLogeado.php"; ?>


        <link rel="stylesheet" href="../../Estilos/alumno.css">
        <div class="main-content">
            <?php include "../../menuLateral/Admin/menuAdmin.php"; ?>
            <section class="main-info">

                <div class="breadcrumbs">
                    <h1 id="breadcrumbs-title">Admin / <span>Gestión Empresas</span></h1>
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
                    <h2 class="card-title">Gestión Empresas</h2>
                    <hr class="hr-divider">
                    <div class="cardContent">
                        <div class="cardInfo">
                            <?php include "listarempresa.php" ?>
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
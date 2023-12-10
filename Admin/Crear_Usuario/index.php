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
                    <h1 id="breadcrumbs-title">Admin / <span>Crear Alumno</span></h1>
                    <div class="breadcrumb-dropdown enlace-caja">
                        <ul>
                            <a href="../../Inicio/Inicio_Admin/index.php">
                                <li id="Inicio"><i class="material-icons">home</i> Inicio</li>
                            </a>
                            <hr>
                            <a href="../../Admin/Alertas/index.php">
                                <li><i class="material-icons">notifications</i><span id="num_alerta">Mis Alertas:
                                        <?php echo $_SESSION['numalertas']?></span></li>
                            </a>
                            <a href="../../Admin/Gestion_Empresa/index.php">
                                <li><i class="material-icons">business</i> Gestión de empresas</li>
                            </a>
                            <a href="../../Admin/Gestion_Usuario/index.php">
                                <li><i class="material-icons">people</i> Gestión de alumnos</li>
                            </a>
                            <hr>
                            <a href="../../Admin/Validar_Empresa/index.php">
                                <li><i class="material-icons">check_circle</i> Activar empresa</li>
                            </a>
                            <a href="../../Admin/Validar_Usuario/index.php">
                                <li><i class="material-icons">check_circle</i> Activar alumno</li>
                            </a>
                            <a href="../../Admin/Validar_oferta/index.php">
                                <li><i class="material-icons">check_circle</i> Activar oferta</li>
                            </a>
                            <hr>
                            <a href="../../Admin/Crear_Admin/index.php">
                                <li><i class="material-icons">person_add</i> Crear administrador</li>
                                <a href="../../Admin/Crear_Usuario/index.php">
                                    <li><i class="material-icons">person_add</i> Crear Alumno</li>
                                </a>
                                <a href="../../Admin/Crear_Empresa/index.php">
                                    <li><i class="material-icons">person_add</i> Crear Empresa</li>
                                </a>
                                <hr>
                                <a href="../../Cambiar_Clave/Admin/Cambiar_Clave_Admin.php">
                                    <li><i class="material-icons">vpn_key</i> Cambiar contraseña</li>
                                </a>
                        </ul>
                    </div>
                </div>
                <article class="card">
                    <h2 class="card-title">Crear Alumno</h2>
                    <hr class="hr-divider">
                    <div class="cardContent">
                        <div class="cardInfo">
                            <?php include "crear_usuario.php" ?>
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
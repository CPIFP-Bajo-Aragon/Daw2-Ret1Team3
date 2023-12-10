<link rel="shortcut icon" href="../../../Imagenes/icon/icon.png">
<?php
include "../../Funciones/conexion.php";
session_start();
$dni = $_SESSION['dni'];
$username = $_SESSION['Nombre_Usuario'];

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
            <nav class="main-menu">
            <ul>
                    <a href="../../Inicio/Inicio_Empresa/index.php">
                        <li id="Inicio"><i class="material-icons">home</i> Inicio</li>
                    </a>
                    <a href="../../Empresa/Alertas/index.php">
                        <li><i class="material-icons">notifications</i><span id="num_alerta">Mis Alertas:
                                <?php echo $_SESSION['numalertas']?></span></li>
                    </a>
                    <a href="../../Empresa/Mensajes/mensaje.php">
                        <li><i class="material-icons">email</i> Mensajes</li>
                    </a>
                    <a href="../../Empresa/Crear_Oferta/Crear_Oferta.php">
                        <li><i class="material-icons">post_add</i> Crear ofertas</li>
                    </a>
                    <a href="../../Empresa/Mis_Ofertas/ofertas.php">
                        <li><i class="material-icons">work</i> Mis ofertas</li>
                    </a>
                    <hr>
                    <a href="../../Empresa/Listar_Candidatos/index.php">
                        <li><i class="material-icons">search</i> Buscar candidatos</li>
                    </a>
                    <hr>
                    <a href="../../Cambiar_Clave/Empresa/Cambiar_Clave_Empresa.php">
                        <li><i class="material-icons">vpn_key</i> Cambiar contraseña</li>
                    </a>
                </ul>  
            </nav>
            <section class="main-info">
                <div class="breadcrumbs">
                    <h1 id="breadcrumbs-title">Alumno / <span>Buscar ofertas</span></h1>
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
                    <h2 class="card-title">Buscar Ofertas</h2>
                    <hr class="hr-divider">
                    <div class="cardContent">
                        <div class="cardInfo">
                            <?php include "buscar_ofertas.php" ?>
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
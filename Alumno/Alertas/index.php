<link rel="shortcut icon" href="../../../Imagenes/icon/icon.png">
<?php
include "../../Funciones/conexion.php";
session_start();
$dni = $_SESSION['dni'];
$username = $_SESSION['Nombre_Usuario'];
if (!isset($_SESSION['dni'])) {
    header("Location: ../../index.php");
    exit();
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
</head>

<body>



    <main>

        <?php include "../../Header/CabeceraLogeado.php"; ?>
        <link rel="stylesheet" href="../../Estilos/alumno.css">
        <div class="main-content">
            <nav class="main-menu">
                <ul>
                    <a href="../../Inicio/Inicio_Alumno/index.php">
                        <li id="Inicio">Inicio</li>
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
                    <h1 id="breadcrumbs-title">Alumno / <span>Mis alertas</span></h1>
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
                <article class="card noAlertas">
                    <p id="resultado"></p>
                </article>

                <?php
                $sql = "SELECT * FROM Alertas where DNI_CIF = '$dni' AND Vista=1";

                if ($result = $conexion->query($sql)) {
                    $sqlfilas = $result->rowCount();

                    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                        $Id_Alerta = $row->Id_Alerta;
                        $Alerta = $row->Alerta;
                        ?>
                <article class="card">
                    <p>
                        <?php echo $Alerta ?>
                    </p>
                    <form action="desactivaralerta.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $Id_Alerta ?>">
                        <input type="submit" value="Marcar como leída" />
                    </form>
                </article>

                <?php
                    }
                }
                if ($sqlfilas == 0) {
                    ?>
                <script>
                document.getElementById("resultado").innerHTML = "No tienes alertas actualmente :)";
                var verAlertas = document.querySelector(".noAlertas");
                verAlertas.style.display = "block";
                </script>
                <?php
                }
                ?>

            </section>
        </div>
        <div class="footer">
            <?php include "../../Footer/footer.php"; ?>
        </div>
    </main>
</body>

</html>
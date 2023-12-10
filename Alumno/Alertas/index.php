<link rel="shortcut icon" href="../../../Imagenes/icon/icon.png">
<?php
include "../../Funciones/conexion.php";
$dni = $_SESSION['dni'];
$username = $_SESSION['Nombre_Usuario'];
if (!isset($_SESSION['dni'])) {
    header("Location: ../../index");
    exit();
}
if($_SESSION['Tipo_Usuario']=='Empresa'){
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
    <title>Mis Alertas</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    <main>

        <?php include "../../Header/CabeceraLogeado.php"; ?>
        <link rel="stylesheet" href="../../Estilos/alumno.css">
        <div class="main-content">
            <?php include "../../menuLateral/Alumno/menuAlumno.php"; ?>
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
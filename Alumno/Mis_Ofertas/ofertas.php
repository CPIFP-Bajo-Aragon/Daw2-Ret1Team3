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
    <title>Mis Ofertas</title>
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
                    <h1 id="breadcrumbs-title">Alumno / <span>Mis ofertas</span></h1>
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
                    <p id="resultado"></p>

                    <?php
                    if (isset($_POST['borrar'])) {
                        $id_borrar = $_POST['id'];
                        $queryborrar = "DELETE FROM Alumno_Oferta WHERE Id_Oferta=$id_borrar";
                        try {
                            $conexion->query($queryborrar);
                            echo "<p>Se ha borrado con exito</p>";
                            //header("Location: ofertas");
                        } catch (PDOException $e) {
                            echo "Error al borrar la consulta";
                            //header("Location: ofertas");
                        }
                    }
                    $queryalumno = "SELECT * FROM Alumno_Oferta WHERE DNI_CIF='$dni'";
                    if ($resultalumno = $conexion->query($queryalumno)) {
                        $sqlfilas = $resultalumno->rowCount();

                        while ($rowalumno = $resultalumno->fetch(PDO::FETCH_OBJ)) {
                        
                            $id_oferta = $rowalumno->Id_Oferta;

                            $queryoferta = "SELECT Oferta.Titulo,Oferta.Descripcion,Municipio.Nombre_Municipio,Usuario.Nombre_Usuario  FROM Oferta,Municipio,Usuario,Empresa
                            WHERE Oferta.DNI_CIF=Empresa.DNI_CIF 
                            AND Oferta.Id_Municipio=Municipio.Id_Municipio
                            AND Empresa.DNI_CIF=Usuario.DNI_CIF
                            AND Oferta.Activo = 1
                            And Oferta.Id_Oferta= $id_oferta";
                            if ($resultoferta = $conexion->query($queryoferta)) {
                                while ($rowoferta = $resultoferta->fetch(PDO::FETCH_OBJ)) {
                                    $titulo = $rowoferta->Titulo;
                                    $descripcion = $rowoferta->Descripcion;
                                    $nombre_municipio = $rowoferta->Nombre_Municipio;
                                    $nombre_usuario = $rowoferta->Nombre_Usuario;
                                    ?>
                    <div class="div1">
                        <?php
                                        echo "                <div id='misofertasborde'>
                                        <p> Nombre de la Empresa: " . $nombre_usuario . "</p><br>";
                                        echo "<p>  <strong>Titulo: </strong> " . $titulo . "</p><br>";
                                        ;
                                        echo "<p> <strong>Descripcion</strong>:<br> <br>" . nl2br($descripcion) . "</p><br>";
                                        echo "<p>  <strong>Municipio: </strong> " . $nombre_municipio . "</p>";
                                        ?>
                        <form METHOD="POST" action="ofertas">
                            <input type="hidden" name="id" value="<?php echo $id_oferta ?>">
                            <input type="submit" name="borrar" value="Borrar Inscripcion">
                        </form>

                    </div>
        </div>
        <?php
                                }
                            }
                        }
                    }
                    ?>
        </article>

        </section>
        </div>
        <div class="footer">
            <?php include "../../Footer/footer.php"; ?>
        </div>
    </main>

</body>

</html>
<?php
if ($sqlfilas == 0) {
    ?>
<script>
document.getElementById("resultado").innerHTML = "No estas inscrito en ninguna oferta actualmente :)";
</script>
<?php
}
?>
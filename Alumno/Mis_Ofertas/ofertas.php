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
                            echo "Se ha borrado con exito";
                            header("Location: ofertas.php");
                        } catch (PDOException $e) {
                            echo "Error al borrar la consulta";
                            header("Location: ofertas.php");
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
                                        echo "<p> Nombre de la Empresa: " . $nombre_usuario . "</p>";
                                        echo "<p> Titulo: " . $titulo . "</p>";
                                        ;
                                        echo "<p> Descripcion: " . $descripcion . "</p>";
                                        echo "<p> Municipio: " . $nombre_municipio . "</p>";
                                        ?>
                                        <form METHOD="POST" action="ofertas.php">
                                            <input type="hidden" name="id" value="<?php echo $id_oferta ?>">
                                            <input type="submit" name="borrar" value="Borrar Inscripcion">
                                            <?php
                                            ?>
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
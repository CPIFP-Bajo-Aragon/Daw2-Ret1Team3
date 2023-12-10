<?php
include "../../Funciones/conexion.php";


$dni = $_SESSION['dni'];
$username = $_SESSION['username'];
$sql = $conexion->prepare("SELECT MAX(Id_Oferta) AS UltimoId FROM Oferta WHERE DNI_CIF = ?");
$sql->bindParam(1, $dni);

if ($sql->execute()) {
    if ($row = $sql->fetch(PDO::FETCH_OBJ)) {
        $UltimoId = $row->UltimoId;
        $_SESSION['ultimoID'] = $UltimoId;

    }
} else {
    echo "Error en la ejecución de la consulta: " . $sql->errorInfo()[2];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Estilos/alumno.css">
    <title>Document</title>
</head>

<body>
    <main>

        <?php include "../../Header/CabeceraLogeado.php"; ?>
        <link rel="stylesheet" href="../../Estilos/alumno.css">
        <div class="main-content">
            <nav class="main-menu">
                <ul>
                    <a href="../../Inicio/Inicio_Alumno/index">
                        <li id="Inicio">Inicio</li>
                    </a>
                    <a href="../../Alumno/Curriculum/curriculum">
                        <li>Curriculum</li>
                    </a>
                    <a href="../../Alumno/Alertas/index">
                        <li>Mis alertas</li>
                    </a>
                    <a href="../../Alumno/Mensajes/mensaje">
                        <li>Mensajes</li>
                    </a>
                    <a href="../../Alumno/Mis_Ofertas/ofertas">
                        <li>Mis ofertas</li>
                    </a>
                    <hr>
                    <a href="../../Alumno/Buscar_Empresas/index">
                        <li>Buscar empresas</li>
                    </a>
                    <a href="../../Alumno/Buscar_Ofertas/index">
                        <li>Buscar ofertas</li>
                    </a>
                    <hr>
                    <a href="../../Cambiar_Clave/Alumno/Cambiar_Clave_Alumno">
                        <li>Cambiar contraseña</li>
                    </a>

                </ul>
            </nav>
            <section class="main-info">
                <div class="breadcrumbs">
                    <h1 id="breadcrumbs-title">Empresa / <span>Mis ofertas</span></h1>
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

                    <p>Titulacion:</p>
                    <form action="Titulacion.php" method="POST">
                        <select id="titulacion" name="titulacion">
                            <option value="">- Titulacion -</option>

                            <?php
                            $query = "SELECT * FROM Titulacion";
                            if ($result = $conexion->query($query)) {
                                while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                                    $Nombre = $row->Nombre;
                                    $Id_Tipo_Titulacion = $row->Id_Tipo_Titulacion;
                                    echo "<option value='$Id_Tipo_Titulacion'>$Nombre</option>";
                                }
                            }
                            ?>
                        </select>
                        <input type="submit" value="Enviar">

                    </form>
                    <?php
                    $querydos = "SELECT * FROM Titulacion, Oferta_Tipo_Titulacion where Id_Oferta=$UltimoId and Titulacion.Id_Tipo_Titulacion=Oferta_Tipo_Titulacion.Id_Tipo_Titulacion ";
                    if ($result = $conexion->query($querydos)) {
                        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                            $Nombre = $row->Nombre;

                            ?>
                    <p class="objetosOfertaAnadidos">
                        <?php echo $Nombre ?>
                    </p>
                    <?php
                        }
                    }
                    ?>


                    <hr>
                    <!-- ------------------------------------------------------------------------------------------ -->

                    <p>Idioma:</p>

                    <form action="Idioma.php" method="POST">
                        <select name="Idioma" id="">
                            <?php
                            $sql = "SELECT * FROM Idioma";
                            if ($resultado = $conexion->query($sql)) {
                                ?>
                            <option value="">- Idioma -</option>
                            <?php
                                while ($row = $resultado->fetch(PDO::FETCH_OBJ)) {
                                    $Idioma = $row->Idioma;
                                    $Id_Idioma = $row->Id_Idioma;
                                    ?>
                            <option value="<?php echo $Id_Idioma ?>">
                                <?php echo $Idioma ?>
                            </option>
                            <?php

                                }
                                ?>
                        </select>
                        <?php
                            }
                            ?>
                        <select name="Nivel" id="">
                            <?php
                            $sql = "SELECT * FROM Nivel";
                            if ($resultado = $conexion->query($sql)) {
                                ?>
                            <option value="">- Nivel -</option>
                            <?php
                                while ($row = $resultado->fetch(PDO::FETCH_OBJ)) {
                                    $Nivel = $row->nivel;
                                    $Id_Nivel = $row->Id_Nivel;
                                    ?>
                            <option value="<?php echo $Id_Nivel ?>">
                                <?php echo $Nivel ?>
                            </option>
                            <?php

                                }
                                ?>
                        </select>
                        <?php
                            }
                            ?>

                        <input type="submit" value="Enviar">
                    </form>

                    <?php
                    $querydos = "SELECT * FROM Idioma, Nivel, Oferta_Nivel_Idioma where Id_Oferta=$UltimoId and Idioma.Id_Idioma=Oferta_Nivel_Idioma.Id_Idioma and Nivel.Id_Nivel=Oferta_Nivel_Idioma.Id_Nivel ";
                    if ($result = $conexion->query($querydos)) {
                        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                            $nivel = $row->nivel;
                            $Idioma = $row->Idioma;

                            ?>
                    <p class="objetosOfertaAnadidos">
                        <?php echo $Idioma ?> ->
                        <?php echo $nivel ?>
                    </p>
                    <?php
                        }
                    }
                    ?>
                    <!-- ------------------------------------------------------------------------------------------ -->

                    <hr>
                    <p>Hard:</p>

                    <form action="Hard.php" method="POST">
                        <select name="Hard">
                            <?php
                            $query = "SELECT * FROM Hard_Skill";
                            if ($result = $conexion->query($query)) {
                                while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                                    $nombre = $row->nombre;
                                    $Id_Hard = $row->Id_Hard;
                                    echo "<option value='$Id_Hard'>$nombre</option>";
                                }
                            }
                            ?>
                        </select>
                        <input type="submit" value="Enviar">

                    </form>
                    <?php
                    $querydos = "SELECT * FROM Hard_Skill, Oferta_Hard_Skill where Id_Oferta=$UltimoId and Oferta_Hard_Skill.Id_Hard=Hard_Skill.ID_Hard";
                    if ($result = $conexion->query($querydos)) {
                        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                            $Nombre = $row->nombre;

                            ?>
                    <p class="objetosOfertaAnadidos">
                        <?php echo $Nombre ?>
                    </p>
                    <?php
                        }
                    }
                    ?>

                    <!-- ------------------------------------------------------------------------------------------ -->

                    <hr>
                    <p>Soft:</p>
                    <form action="Soft.php" method="POST">
                        <select name="Soft">
                            <?php
                            $query = "SELECT * FROM Soft_Skill";
                            if ($result = $conexion->query($query)) {
                                while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                                    $nombre = $row->nombre;
                                    $Id_Soft = $row->Id_Soft;
                                    echo "<option value='$Id_Soft'>$nombre</option>";
                                }
                            }
                            ?>
                        </select>
                        <input type="submit" value="Enviar">

                    </form>
                    <?php
                    $querydos = "SELECT * FROM Soft_Skill, Oferta_Soft_Skill where Id_Oferta=$UltimoId and Oferta_Soft_Skill.Id_Soft=Soft_Skill.ID_Soft";
                    if ($result = $conexion->query($querydos)) {
                        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                            $Nombre = $row->nombre;

                            ?>
                    <p class="objetosOfertaAnadidos">
                        <?php echo $Nombre ?>
                    </p>
                    <?php
                        }
                    }
                    ?>
                    <!-- ------------------------------------------------------------------------------------------ -->






                </article>
                <a href="../Mis_Ofertas/ofertas.php"><button>Mis ofertas</button></a>
            </section>
        </div>
        <div class="footer">
            <?php include "../../Footer/footer.php"; ?>
        </div>




</body>

</html>
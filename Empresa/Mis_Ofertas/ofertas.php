<link rel="shortcut icon" href="../../../Imagenes/icon/icon.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="../../Estilos/ofertas.css">
<?php
include "../../Funciones/conexion.php";
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
</head>

<body>



    <main>

        <?php include "../../Header/CabeceraLogeado.php"; ?>
        <link rel="stylesheet" href="../../Estilos/alumno.css">
        <div class="main-content">
            <?php include "../../menuLateral/Empresa/menuEmpresa.php"; ?>
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
                    <h2 class="card-title">Mis Ofertas</h2>
                    <hr class="hr-divider">
                    <p class="mensaje-error" id="resultado"></p>


                    <?php

                    if (isset($_POST['borrar'])) {
                        $id_borrar = $_POST['id'];
                        $queryborrar = "DELETE FROM Alumno_Oferta WHERE Id_Oferta=$id_borrar";
                        try {

                            $conexion->query($queryborrar);


                            echo "Se ha borrado con exito";
                            header("Location: ofertas");
                        } catch (PDOException $e) {
                            echo "Error al borrar la consulta";
                            header("Location: ofertas");
                        }
                    }




                    $queryalumno = "SELECT * FROM Oferta WHERE DNI_CIF='$dni'";
                    if ($resultalumno = $conexion->query($queryalumno)) {
                        

                        while ($rowalumno = $resultalumno->fetch(PDO::FETCH_OBJ)) {
                            $id_oferta = $rowalumno->Id_Oferta;

                            $queryoferta = "SELECT Oferta.Titulo,Oferta.Descripcion,Oferta.Vacantes,Oferta.Fecha_Publicacion,Oferta.Fecha_Inicio,Oferta.Fecha_Fin, Oferta.Activo,Municipio.Nombre_Municipio,paises.nombre,Oferta.Coche,Oferta.Movilidad 
                            FROM Oferta,Municipio,paises,Empresa
                            WHERE Oferta.Id_Municipio=Municipio.Id_Municipio
                            AND Oferta.Id_Pais=paises.id
                            AND Oferta.DNI_CIF=Empresa.DNI_CIF
                            And Oferta.DNI_CIF='$dni'
                            AND Oferta.Id_Oferta=$id_oferta
                            AND (Oferta.Activo=0 
                            OR   Oferta.Activo=1)";


                            if ($resultoferta = $conexion->query($queryoferta)) {
                                while ($rowoferta = $resultoferta->fetch(PDO::FETCH_OBJ)) {
                                    $titulo = $rowoferta->Titulo;
                                    $descripcion = $rowoferta->Descripcion;
                                    $vacantes = $rowoferta->Vacantes;
                                    $fecha_incripcion = $rowoferta->Fecha_Publicacion;
                                    $fecha_inicio = $rowoferta->Fecha_Inicio;
                                    $fecha_fin = $rowoferta->Fecha_Fin;
                                    $nombre_municipio = $rowoferta->Nombre_Municipio;
                                    $nombre_pais = $rowoferta->nombre;
                                    $coche=$rowoferta->Coche;
                                    $movilidad=$rowoferta->Movilidad;
                                    $Activo = $rowoferta->Activo;
                                    $sqlfilas = $resultalumno->rowCount();
                                    ?>
                    <div class="divCardOferta">
                        <?php
                                        echo "<h4>Datos de la Oferta</h4>";
                                        echo "<p> Titulo de la Oferta: " . $titulo . "</p>";
                                        echo "<p> Descripcion: " . $descripcion . "</p>";
                                        echo "<p> Vacantes: " . $vacantes . "</p>";
                                        echo "<p> Fecha_Inscripcion: " . $fecha_incripcion . "</p>";
                                        echo "<p> Fecha Inicio: " . $fecha_inicio . "</p>";
                                        echo "<p> Fecha Fin: " . $fecha_fin . "</p>";
                                        echo "<p> Municipio: " . $nombre_municipio . "</p>";
                                        echo "<p> Pais: " . $nombre_pais . "</p>";
                                       if($coche==0){
                                        echo "<p> Coche Propio: No</p>";
                                       }else{
                                        echo "<p> Coche Propio: Si</p>";
                                       }
                                       if($movilidad==0){
                                        echo "<p> Movilidad: No</p>";
                                       }else{
                                        echo "<p> Movilidad: Si</p>";
                                       }

                                        ?>
                        <?php
                                        
                                        $queryhard = "SELECT Hard_Skill.nombre FROM Hard_Skill,Oferta_Hard_Skill WHERE Hard_Skill.Id_Hard=Oferta_Hard_Skill.Id_Hard And Id_Oferta=$id_oferta";
                                        if ($resulthard = $conexion->query($queryhard)) {
                                        if ($resulthard->rowCount() > 0) {
                                            echo "<h4>Hard Skills</h4>";
                                            while ($rowhard = $resulthard->fetch(PDO::FETCH_OBJ)) {
                                                $nombre_hard = $rowhard->nombre;
                                                echo "<p>" . $nombre_hard . "</p>";
                                            }
                                        }
                                    }
                                        ?>
                        <?php
                                        
                                        $querysoft = "SELECT Soft_Skill.nombre FROM Soft_Skill,Oferta_Soft_Skill WHERE Soft_Skill.Id_Soft=Oferta_Soft_Skill.Id_Soft And Id_Oferta=$id_oferta";
                                        if ($resultsoft = $conexion->query($querysoft)) {
                                        if ($resultsoft->rowCount() > 0) {
                                            echo "<h4>Soft Skills</h4>";
                                            while ($rowsoft = $resultsoft->fetch(PDO::FETCH_OBJ)) {
                                                $nombre_soft = $rowsoft->nombre;

                                                echo "<p>" . $nombre_soft . "</p>";
                                            }
                                        }
                                    }
                                        ?>


                        <?php
                                        
                                        $querytitulo = "SELECT Titulacion.Nombre, Titulacion.Tipo FROM Titulacion,Oferta_Tipo_Titulacion WHERE Titulacion.Id_Tipo_Titulacion=Oferta_Tipo_Titulacion.Id_Tipo_Titulacion And Id_Oferta= $id_oferta";
                                        if ($resultitulo = $conexion->query($querytitulo)) {
                                            if ($resultitulo->rowCount() > 0) {
                                                echo "<h4>Titulaciones</h4>";
                                            while ($rowtitulo = $resultitulo->fetch(PDO::FETCH_OBJ)) {
                                                $nombre_titulacion = $rowtitulo->Nombre;
                                                $tipo_titulacion = $rowtitulo->Tipo;
                                                echo "<p>" . $tipo_titulacion . " - " . $nombre_titulacion . "</p>";
                                            }
                                        }
                                    }
                                        ?>
                        <?php
                                    
                                        $queryidioma = "SELECT Idioma.Idioma,Nivel.nivel FROM Idioma,Nivel,Oferta_Nivel_Idioma WHERE Idioma.Id_Idioma=Oferta_Nivel_Idioma.Id_Idioma AND Nivel.Id_Nivel=Oferta_Nivel_Idioma.Id_Nivel And Id_Oferta=$id_oferta";
                                        if ($resultidioma = $conexion->query($queryidioma)) {
                                               if ($resultidioma->rowCount() > 0) {
                                                echo "<h4>Idiomas</h4>";
                                            while ($rowidioma = $resultidioma->fetch(PDO::FETCH_OBJ)) {
                                                $nombre_idioma = $rowidioma->Idioma;
                                                $nombre_nivel = $rowidioma->nivel;

                                                echo "<p>" . $nombre_idioma . "</p>";
                                                echo "<p>" . $nombre_nivel . "</p>";
                                            }
                                        }
                                    }
                                        
                                        ?>


                        <div class="misOfertasBotones">

                            <button onclick="showModal3('<?php echo $id_oferta; ?>')">Eliminar</button>

                            <form id='formulario3' action="borrarOferta.php" method="POST">
                                <input type="hidden" name="Id_oferta" id="Id_oferta" value="<?php $id_oferta;?>">
                                <input type="hidden" id="confirmacionEliminacion3" name="confirmacionEliminacion3"
                                    value="false">

                                <div class="modal3" id="myModal3">
                                    <div id="modal-content3" class="modal-content3"></div>
                                </div>

                                <script>
                                function showModal3(Id_oferta) {
                                    var modal = document.getElementById('myModal3');
                                    modal.style.display = 'block';

                                    document.getElementById('modal-content3').innerHTML =
                                        "<p>¿Estás seguro que quieres eliminarlo?</p>" +
                                        "<button  class=abrir onclick=\"confirmar3('" + Id_oferta +
                                        "')\">Confirmar</button>" +
                                        "<button id='cerrar' class='cerrar2' onclick='hideModal3()'>Cancelar</button>"
                                }

                                function hideModal3() {
                                    var modal = document.getElementById('myModal3');
                                    modal.style.display = 'none';
                                }

                                function confirmar3(Id_oferta) {
                                    document.getElementById('Id_oferta').value = Id_oferta;
                                    document.getElementById('confirmacionEliminacion3').value = "true";
                                    document.getElementById('formulario3').submit();
                                }
                                </script>
                            </form>

                            <form METHOD="POST" action="editarOferta">
                                <input type="text" name="Id_Oferta" value="<?php echo $id_oferta ?>">
                                <input type="submit" name="editar" value="Editar oferta">
                            </form>

                            <form action="../Candidatos/index.php" method="post">
                                <input type="hidden" name="idoferta" id="" value="<?php echo $id_oferta ?>">
                                <input type="submit" name="inscritos" value="Ver Inscritos">
                            </form>

                            <!-- BOTÓN PARA ACTIVAR LAS OFERTAS -->


                            <!-- HACER UN IF ACTIVO = 1 SALE ES OY SINO EL OTRO -->

                            <?php

                                            if ($Activo == 0) {
                                                ?>
                            <form action="activarOferta.php" method="post">
                                <input type="hidden" name="idoferta" id="" value="<?php echo $id_oferta ?>">
                                <input type="submit" name="activarOferta" id="activaroferta" value="Activar oferta">
                            </form>
                            <?php
                                            } else {
                                                ?>
                            <form action="activarOferta.php" method="post">
                                <input type="hidden" name="idoferta" id="" value="<?php echo $id_oferta ?>">
                                <input type="submit" name="desactivarOferta" id="desactivaroferta"
                                    value="Desactivar oferta">
                            </form>
                            <?php
                                            }

                                            ?>
                        </div>

                    </div>
                    <?php
                                }
                            }



                        }
                    }

                   


                    ?>
                </article>
                <p style="text-align:center; color:gray;">Si su oferta no aparece aqui es probable que este pendiente de
                    ser validada por un Administrador</p>

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
document.getElementById("resultado").innerHTML = "Todavía no has creado ninguna oferta";
</script>
<?php
}
?>
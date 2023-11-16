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
        <link rel="stylesheet" href="../../Estilos/mensajes.css">
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
                    <h1 id="breadcrumbs-title">Alumno / <span>Mensajes</span></h1>
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


                    <p>Chats Activos actualmente</p>
                    <!-- Vamos a recoger el dni del emisor  -->
                    <?php


                 if (isset($_POST['dni_usuario'])) {
                     $dni_usuario = $_POST['dni_usuario'];
                 } else {
                     $dni_usuario = "";
                 };
             

                    $dni_origen = $_SESSION['dni'];
                   
                    $dni_destino= $_POST['dni_usuario'];

                   

                    
                     if (isset($_POST['dni_usuario'])){
                        $dni_destino= $_POST['dni_usuario'];
                    } else {
                        $dni_destino =  $_SESSION['dni_usuario_mensaje'] ; 
                    }

                    $_SESSION['dni_usuario_mensaje'] = $dni_usuario;
                    if ($dni_destino ==  $dni_origen){
?> <script>
                    boton.disabled = true;
                    </script>
                    <?php
                    }

                    $chats_participado = "SELECT Origen_Mensaje, Destino_Mensaje  FROM bolsa_emplea.Mensaje where Destino_Mensaje='$dni_origen' group by Origen_Mensaje";
                    ?>
                    <div class="chatsDisponibles">
                        <?php
                            if ($resultado_mensaje = $conexion->query($chats_participado)) {
                                while ($row = $resultado_mensaje->fetch(PDO::FETCH_OBJ)) {
                                    $Origen_DNI_Chat = $row->Origen_Mensaje;
                                    $Destino_DNI_Chat = $row->Destino_Mensaje;
                                    ?>


                        <form action="mensaje.php" method="post">
                            <input type="hidden" value="<?php echo $Origen_DNI_Chat ?>" name="dni_usuario"
                                id="dni_usuario">
                            <?php
                                        $sql_nombre = "SELECT Nombre_Usuario FROM `Usuario` WHERE DNI_CIF='$Origen_DNI_Chat'";
                                        $resultado_nombre = $conexion->query($sql_nombre);

                                        while ($row_nombre = $resultado_nombre->fetch(PDO::FETCH_OBJ)) {
                                            $Nombre = $row_nombre->Nombre_Usuario;
                                        }
                                        ?>
                            <input type="submit" value="<?php echo $Nombre ?>">
                        </form>


                        <?php
                                }
                            }




                            ?>
                    </div>
                    <p>Inicia un nuevo chat</p>
                    <form action="mensaje.php" method="post">
                        <input type="text" name="dni_usuario" id="dni_usuario" placeholder="Pon el DNI">
                        <input type="submit" value="Iniciar chat">
                    </form>
                    <hr>

                    <div class="chat">
                        <p>Escribiendo:
                        </p>
                        <div class="chatContent">
                            <?php
        $sql_carga_mensaje = "SELECT * FROM `Mensaje` WHERE (Origen_Mensaje = '$dni_origen' OR  Origen_Mensaje = '$dni_destino') AND (Destino_Mensaje= '$dni_destino' or Destino_Mensaje= '$dni_origen') ORDER BY ID_Mensaje ASC";

        if ($resultado_mensaje = $conexion->query($sql_carga_mensaje)) {
            while ($row = $resultado_mensaje->fetch(PDO::FETCH_OBJ)) {
                $Id_Mensaje = $row->ID_Mensaje;
                $Mensaje = $row->Mensaje;
                $Origen_DNI = $row->Origen_Mensaje;
                $Destino_DNI = $row->Destino_Mensaje;

                $sql_nombre = "SELECT Nombre_Usuario FROM `Usuario` WHERE DNI_CIF='$Origen_DNI'";
                $resultado_nombre = $conexion->query($sql_nombre);


                $sql_nombre_destino = "SELECT Nombre_Usuario FROM `Usuario` WHERE DNI_CIF='$dni_destino'";
                $resultado_nombre_destino = $conexion->query($sql_nombre_destino);



                while ($row_nombre_destino = $resultado_nombre_destino->fetch(PDO::FETCH_OBJ)) {
                    $Nombre_destino = $row_nombre_destino->Nombre_Usuario;
                }


                while ($row_nombre = $resultado_nombre->fetch(PDO::FETCH_OBJ)) {
                    $Nombre = $row_nombre->Nombre_Usuario;
                }

                $esUsuarioSesion = ($username == $Nombre);

                $claseMensaje = ($esUsuarioSesion) ? 'Mensaje_origen_usuario' : 'Mensaje_origen';

                ?>
                            <p class="<?php echo $claseMensaje; ?>">
                                <?php echo $Nombre . " - " . $Mensaje ?>
                            </p>
                            <?php
            }
        }
        $frase = "Inicia el chat con alguien para poder enviar mensjaes"; // Inicializa la variable fuera del bloque condicional

        if (empty($Nombre_destino)) {
            $Nombre_destino = "";
        } else {
            $frase = "Enviar mensaje a " . $Nombre_destino;
        }
        if (isset($_GET['enviado']) && $_GET['enviado'] == 'true') {
            echo "<script>
            window.onload = function() {
                var mensajeEnviadoDiv = document.getElementById('mensaje_enviado');
                mensajeEnviadoDiv.innerHTML = 'Mensaje enviado';
                mensajeEnviadoDiv.style.display = 'block';
            };
          </script>";
        } else {
            echo "<script>
            window.onload = function() {
                var mensajeEnviadoDiv = document.getElementById('mensaje_enviado');
                mensajeEnviadoDiv.innerHTML = 'No puedes enviar este mensaje';
                mensajeEnviadoDiv.style.display = 'block';
            };
          </script>";
        }
        ?>
                            <form action="enviarmensaje.php" method="post">
                                <input type="hidden" name="dni_destino" id="dni_destino"
                                    value="<?php echo $dni_destino ?>">
                                <input type="text" name="mensaje" id="mensaje" maxlength="60">
                                <input type="submit" id="boton" value="<?php echo $frase; ?>"
                                    <?php echo empty($Nombre_destino) ? 'disabled' : ''; ?>>
                            </form>
                            <div id="mensaje_enviado" style="display: none;"></div>

                        </div>
                    </div>



                </article>

            </section>
        </div>
        <div class="footer">
            <?php include "../../Footer/footer.php"; ?>
        </div>
</body>

</html>
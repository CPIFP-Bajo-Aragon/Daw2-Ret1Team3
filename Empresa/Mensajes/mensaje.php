<?php

include "../../Funciones/conexion.php";

if (!isset($_SESSION["dni"])) {
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
$dni = $_SESSION["dni"];
$username = $_SESSION["Nombre_Usuario"];
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
    <title>Mensajes</title>
    <link rel="stylesheet" href="../../Estilos/mensajes.css">
    <link rel="stylesheet" href="../../Estilos/alumno.css">
    <link rel="shortcut icon" href="../../../Imagenes/icon/icon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    <main>

        <?php include "../../Header/CabeceraLogeado.php"; ?>


        <?php include "../../menuLateral/Empresa/menuEmpresa.php"; ?>
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


                <p>Chats Activos actualmente </p>
                <div id="uso-de-chat">
                    <div class="chatsDisponibles" id="chatdisponible">

                        <?php
                        $chats_participado = "SELECT Origen_Mensaje, Destino_Mensaje  FROM bolsa_emplea.Mensaje where Destino_Mensaje='$dni' group by Origen_Mensaje";
                        if ($resultado_mensaje = $conexion->query($chats_participado)) {
                            while ($row = $resultado_mensaje->fetch(PDO::FETCH_OBJ)) {
                                $Origen_DNI_Chat = $row->Origen_Mensaje;
                                $Destino_DNI_Chat = $row->Destino_Mensaje;
                                ?>
                        <form action="mensaje" method="post">
                            <input type="hidden" value="<?php echo $Origen_DNI_Chat; ?>" name="dni_usuario"
                                id="dni_usuario">
                            <?php
                                    $sql_nombre = "SELECT Nombre_Usuario FROM `Usuario` WHERE DNI_CIF='$Origen_DNI_Chat'";
                                    $resultado_nombre = $conexion->query($sql_nombre);

                                    while ($row_nombre = $resultado_nombre->fetch(PDO::FETCH_OBJ)) {
                                        $Nombre = $row_nombre->Nombre_Usuario;
                                    }
                                    ?>
                            <input type="submit" value="<?php echo $Nombre; ?>">
                        </form>

                        <?php
                            }
                        }
                        ?>
                        <p style="color:gray">(Para que un chat aparezca como Activo debe existir una contestacion del
                            receptor)

                    </div>
                    <div id="chat-dni">

                        </p>

                        <p>Inicia un nuevo chat (Mediante su DNI)</p>
                        <form action="mensaje.php" method="post">
                            <input type="text" name="dni_usuario" id="dni_usuario" placeholder="Pon el DNI">
                            <input type="submit" value="Iniciar chat">
                        </form>
                        <?php
                    $dni_destino = "";

                    if (isset($_POST["dni_usuario"])) {
                        $dni_destino = $_POST["dni_usuario"];
                    } else {
                        $dni_destino = $_SESSION["dni_usuario_mensaje"];
                    }

                    if (isset($_POST["dni_usuario"])) {
                        $dni_usuario = $_POST["dni_usuario"];
                    } else {
                        $dni_usuario = "";
                    }

                    $dni_origen = $_SESSION["dni"];
                    $_SESSION["dni_usuario_mensaje"] = $dni_usuario;
                    $botonDeshabilitado = ($dni_destino == $dni_origen) ? 'disabled' : '';
                    ?>
                    </div>
                </div>
                <hr class="hr">

                <h2 id="chat-txt">💬 CHAT 💬</h2>












                <div class="chat">

                    <?PHP 







                    $sql_nombre = "SELECT Nombre_Usuario FROM `Usuario` WHERE DNI_CIF='$dni_destino'";
                            $resultado_nombre_des = $conexion->query($sql_nombre);

                            while ($row_nombre_destino = $resultado_nombre_des->fetch(PDO::FETCH_OBJ)) {
                                $Nombre_destino_inicio = $row_nombre_destino->Nombre_Usuario;
                            }






                         $frase = "Ningun Chat Seleccionado" ; // Inicializa la variable fuera del bloque condicional

                    if (empty($Nombre_destino_inicio)) {
                        $Nombre_destino_inicio = "";
                    } else {
                        $frase = "Enviar mensaje a " . $Nombre_destino_inicio;
                    }
                        ?>

                    <div class="chat">
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

                        $esUsuarioSesion = $username == $Nombre;
                        $claseMensaje = $esUsuarioSesion ? "Mensaje_origen_usuario" : "Mensaje_origen";
                        ?>
                        <p class="<?php echo $claseMensaje; ?>">
                            <?php echo $Nombre . " - " . $Mensaje; ?>
                        </p>
                        <?php
                    }
                }
                ?>
                        <form action="enviarmensaje.php" method="post">
                            <input type="hidden" name="dni_destino" id="dni_destino"
                                value="<?php echo $dni_destino; ?>">
                            <input type="text" name="mensaje" id="mensaje" maxlength="500">
                            <input type="submit" id="boton" value="<?php echo $frase; ?>"
                                <?php echo $botonDeshabilitado; ?>>
                        </form>
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
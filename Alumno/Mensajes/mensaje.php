<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes</title>
</head>
<body>
    <form action="mensaje.php" method="post">
        <input type="text" name="dni_usuario" id="dni_usuario" placeholder="Pon el DNI">
        <input type="submit" value="Iniciar chat">
    </form>
    <!-- Vamos a recoger el dni del emisor  -->
    <?php 
        session_start();
        include "../../Funciones/conexion.php";

        $dni_origen=$_SESSION['dni'];
        if (isset($_POST['dni_usuario'])) {
            $_SESSION['dni_usuario_mensaje'] = $_POST['dni_usuario'];
        }
        
        $dni_destino=$_SESSION['dni_usuario_mensaje'];
        
         




        $sql_carga_mensaje = "SELECT * FROM `Mensaje` WHERE (Origen_Mensaje = '$dni_origen' OR  Origen_Mensaje = '$dni_destino')AND (Destino_Mensaje= '$dni_destino' or Destino_Mensaje= '$dni_origen') ORDER BY ID_Mensaje ASC  ";

if ($resultado_mensaje = $conexion->query($sql_carga_mensaje)) {
    while ($row = $resultado_mensaje->fetch(PDO::FETCH_OBJ)) {
        $Id_Mensaje = $row->ID_Mensaje;
        $Mensaje = $row->Mensaje;
        $Origen_DNI = $row->Origen_Mensaje;
        $Destino_DNI = $row->Destino_Mensaje;

        $sql_nombre = "SELECT Nombre_Usuario FROM `Usuario` WHERE DNI_CIF='$Origen_DNI'";
        $resultado_nombre = $conexion->query($sql_nombre);

        while ($row_nombre = $resultado_nombre->fetch(PDO::FETCH_OBJ)) {
            $Nombre = $row_nombre->Nombre_Usuario;
        }
        ?>
        <p class="Mensaje_origen"><?php echo $Nombre . " - " . $Mensaje ?></p>
        <?php
    }
}
    ?>
    <form action="enviarmensaje.php" method="post">
        <input type="hidden" name="dni_destino" id="dni_destino" value="<?php echo $dni_destino ?>">
        <input type="text" name="mensaje" id="mensaje">
        <input type="submit" value="Enviar mensaje">
    </form>
</body>
</html>
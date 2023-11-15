<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes</title>
    <link rel="stylesheet" href="../../Estilos/alumno.css">

</head>
<body>
        <main>
            <header class="main-header">
                <img src="../../Imagenes/Profitech.png" alt="">
                <div class="conInfo">
                    <div class="conInfo">
                        <p>Hola, // echo $username</p>
                        <form action="cerrarSesion.php" method="post">
                            <input type="submit" value="Cerrar sesión" />
                        </form>
                    </div>
            </header>
            <div class="main-content">
                <nav class="main-menu">
                    <ul>
                        <a href="#">
                            <li>Inicio</li>
                        </a>
                        <a href="#">
                            <li>Curriculum</li>
                        </a>
                        <a href="../Alertas/index.php">
                            <li>Mis alertas</li>
                        </a>
                        <a href="#">
                            <li>Mensajes</li>
                        </a>
                        <a href="../Mis_Ofertas/ofertas.php">
                            <li>Mis ofertas</li>
                        </a>
                        <hr>
                        <a href="/../Alumno/Buscar_Empresas/index.php">
                            <li>Buscar empresas</li>
                        </a>
                        <a href="/../Alumno/Buscar_Ofertas/index.php">
                            <li>Buscar ofertas</li>
                        </a>
                        <hr>
                        <a href="../../Cambiar_Clave/Alumno/Cambiar_Clave_Alumno.php">
                            <li>Cambiar contraseña</li>
                        </a>

                    </ul>
                </nav>
                <section class="main-info">
                    <article class="card">


  <p>Chats Activos actualmente</p>
    <!-- Vamos a recoger el dni del emisor  -->
    <?php 
        session_start();
        include "../../Funciones/conexion.php";

        $dni_origen=$_SESSION['dni'];
        if (isset($_POST['dni_usuario'])) {
            $_SESSION['dni_usuario_mensaje'] = $_POST['dni_usuario'];
        }
        
        $dni_destino=$_SESSION['dni_usuario_mensaje'];
        
         
    $chats_participado = "SELECT Origen_Mensaje, Destino_Mensaje  FROM bolsa_emplea.mensaje where Destino_Mensaje='$dni_origen' group by Origen_Mensaje";
    if ($resultado_mensaje = $conexion->query($chats_participado)) {
       while ($row = $resultado_mensaje->fetch(PDO::FETCH_OBJ)) {
           $Origen_DNI_Chat = $row->Origen_Mensaje;
           $Destino_DNI_Chat = $row->Destino_Mensaje;
           ?>
           <form action="mensaje.php" method="post">
               <input type="hidden" value="<?php echo $Origen_DNI_Chat ?>" name="dni_usuario" id="dni_usuario">
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
<p>Inicia un nuevo chat</p>
  <form action="mensaje.php" method="post">
        <input type="text" name="dni_usuario" id="dni_usuario" placeholder="Pon el DNI">
        <input type="submit" value="Iniciar chat">
    </form>
<hr>
<p>Mensajes:</p>
<br>
    <?php

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


    </article>

</section>
</body>

</html>
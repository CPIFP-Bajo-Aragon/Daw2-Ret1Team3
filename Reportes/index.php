<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link rel='stylesheet' href='../style.css' type='text/css'/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://www.google.com/recaptcha/enterprise.js?render=6Ld8OSApAAAAAMD22w253grVRnjOTRr6uTIy5Uq9" async defer></script>
        <link rel="stylesheet" href="style.css">
</head>


      <body>
      <script>
 function onClick(e) {
   e.preventDefault();
   grecaptcha.enterprise.ready(async () => {
     const token = await grecaptcha.enterprise.execute('6Ld8OSApAAAAAMD22w253grVRnjOTRr6uTIy5Uq9', {action: 'LOGIN'});
   });
 }
</script>


        <div class='FlexContainer'>
        <header>
            <div id="divuno">
                <div>
                <img src="../img/logo_cpifp.png" alt="imagen del cpifp bajo aragon">
                <img src="../img/logo_gob_eu.png" alt="Imagen gobierno de aragon">
                </div>
                <div id="button">
                    <a href="../Login/login"><button id="boton_login">
                        Iniciar Sesion
                    </button></a>
                    <a href="../Registro/index"><button id="boton_registro">
                        Registrarse
                    </button></a>
                </div>
            </div>
        </header>
        <h1 style="text-align: center;">Contacto con un Administrador:</h1>

<form action="index.php" method="post" id="form">

    <label for="nombre_completo">Nombre Completo:<span class="campo-obligatorio">*</span></label>
    <input type="text" id="nombre_completo" name="nombre_completo" maxlength="200" required>

    <label for="email">Email:<span class="campo-obligatorio">*</span></label>
    <input type="email" id="email" name="email" maxlength="200" required>


    <label for="mensaje">Mensaje:<span class="campo-obligatorio">*</span></label>
    <textarea id="mensaje" name="mensaje" rows="10" required></textarea>
    <input type="submit" name="enviar" value="Enviar Reporte">
</form>
<footer>
            <div id="divcinco">
                <div>
                    <i class="fa fa-facebook"></i>
                    <i class="fa fa-twitter"></i>
                    <i class="fa fa-instagram"></i>
                    <i class="fa fa-github"></i>
                    
                </div>
                <div id="otroContenido">
                    <p>#PlanDeRecuperacion</p>
                    <p>#NextGenerationEU</p>
                </div>
                <div id="copiright">
                    Profitech Alcañiz © 2002 - 2023 Reservados
                </div>
            </div>
        </footer>
</body>
</html>
<?php

 
include "../Funciones/conexion-inicio.php";
if (!empty($_POST['enviar'])) {

$nombre_completo=$_POST['nombre_completo'];
$email=$_POST['email'];
$mensaje=$_POST['mensaje'];

 $sentencia = $conexion->prepare("INSERT INTO bolsa_emplea.Reporte (Nombre_Completo , Email, Mensaje) VALUES (?, ?, ?)");
 $sentencia->bindParam(1, $nombre_completo);
 $sentencia->bindParam(2, $email);
 $sentencia->bindParam(3, $mensaje);


 try {
    echo "
        <script>
         Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Tu reportes ha sido enviado correctamente',
        showConfirmButton: false,
        timer: 1500
    });
    </script>";
    $sentencia->execute();
} catch (PDOException $e) {
    echo $e->getMessage();
    echo "
        <script>
         Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Tu reporte no ha podido ser enviado',
        showConfirmButton: false,
        timer: 1500
    });
    </script>";
}
   }

?>

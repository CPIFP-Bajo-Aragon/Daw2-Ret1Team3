<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if($_SESSION['Tipo_Usuario']!='Admin'){
        //echo "Acceso no permitido";
        header("Location: ../PermisoDenegado.php");
    }else{
        echo "Acceso permitido";
    }
    ?>
    <h1>PAGINA WEB DE ADMIN!</h1>
    <?php
        echo "<a href=\"../login.php\">Ir a inicio</a>";
    ?>
</body>
</html>
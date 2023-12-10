<?php session_start(); ?> 
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "../../../Funciones/conexion.php"?>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<?php 
        $Idioma=$_POST['Idioma'];
        $Nivel=$_POST['Nivel'];
        $dni=$_SESSION['dni'];
     
   
        $sentencia = $conexion->prepare("INSERT INTO Nivel_Idioma (DNI_CIF, Id_Idioma, id_Nivel) VALUES (?, ?, ?)");
        $sentencia->bindParam(1, $dni);
        $sentencia->bindParam(2, $Idioma);
        $sentencia->bindParam(3, $Nivel);

        try {
            $sentencia->execute();
            header("Location: ../index.php#idiomas");
        } catch (PDOException $e) {
            header("Location: ../index.php#idiomas");
        } 
    ?> 
</body>
</html>
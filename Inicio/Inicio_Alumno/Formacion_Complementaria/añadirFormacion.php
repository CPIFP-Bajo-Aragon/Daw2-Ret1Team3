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
        $Nom=$_POST['Nombre'];
        $Ent=$_POST['Entidad_Emisora'];
        $Fin=$_POST['Fecha_Inicio'];
        $Ffi=$_POST['Fecha_Fin'];
        $Fca=$_POST['Fecha_Caducidad'];
        $Hor=$_POST['Num_Horas'];
        $Descripcion=$_POST['Descripcion'];
        $dni=$_SESSION['dni'];
        
         
        //mirar fecha caducidad error si no se pone informacion

        if($Fca!=""){
        $sentencia = $conexion->prepare("INSERT INTO Formacion_Complementaria (Nombre, Entidad_Emisora, Fecha_Inicio, Fecha_Fin, Fecha_Caducidad, Num_Horas, Descripcion, DNI_CIF) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $sentencia->bindParam(1, $Nom);
        $sentencia->bindParam(2, $Ent);
        $sentencia->bindParam(3, $Fin);
        $sentencia->bindParam(4, $Ffi);
        $sentencia->bindParam(5, $Fca);
        $sentencia->bindParam(6, $Hor);
        $sentencia->bindParam(7, $Descripcion);
        $sentencia->bindParam(8, $dni);
        } else {
            $sentencia = $conexion->prepare("INSERT INTO Formacion_Complementaria (Nombre, Entidad_Emisora, Fecha_Inicio, Fecha_Fin, Num_Horas, Descripcion, DNI_CIF) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $sentencia->bindParam(1, $Nom);
        $sentencia->bindParam(2, $Ent);
        $sentencia->bindParam(3, $Fin);
        $sentencia->bindParam(4, $Ffi);
        $sentencia->bindParam(5, $Hor);
        $sentencia->bindParam(6, $Descripcion);
        $sentencia->bindParam(7, $dni);
        }

        try {
            if(($Fin>$Ffi)){
                echo "<script>";
                echo "alert('Introduce correctamente las fechas ')";
                echo "</script>";
                echo "<script>";
                echo "location.replace('../index.php#Formacion_complementaria')";
                echo "</script>";
            }
            else{
            $sentencia->execute();
            header("Location: ../index.php#Formacion_complementaria");
        
            if (is_null($Fca)) {
                $sentencia->execute();
                header("Location: ../index.php#Formacion_complementaria");
            } else if(!is_null($Fca) && ($Fca<$Ffi)){
               echo "<script>";
                echo "alert('La fecha de caducidad no puede ser menor que la fecha fin ')";
                echo "</script>";
                echo "<script>";
                echo "location.replace('../index.php#Formacion_complementaria')";
                echo "</script>";
            }
        
        }




        } catch (PDOException $e) {
            header("Location: ../index.php");
        } 
    ?>
</body>

</html>
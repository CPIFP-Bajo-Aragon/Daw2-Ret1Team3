<?php include "../../../Funciones/conexion.php" ?>

<body>

    <?php
    $Nom = $_POST['nombre'];
    $Ent = $_POST['Entidad_Emisora'];
    $Fin = $_POST['Fecha_Inicio'];
    $Ffi = $_POST['Fecha_Fin'];
    $Fca = $_POST['Fecha_Caducidad'];
    $Hor = $_POST['Num_Horas'];
    $Descripcion = $_POST['Descripcion'];
    $id = $_POST['Id_Formacion_Complementaria'];
    $dni = $_SESSION['dni'];


    if ($Fca != "") {
        $sentencia = $conexion->prepare("UPDATE Formacion_Complementaria
            SET
            Nombre = ?,
            Entidad_Emisora = ?,
            Fecha_Inicio = ?,
            Fecha_Fin = ?,
            Fecha_Caducidad = ?,
            Num_Horas = ?,
            Descripcion = ?
            WHERE DNI_CIF = ? AND Id_Formacion_Complementaria = ? ");

        $sentencia->bindParam(1, $Nom);
        $sentencia->bindParam(2, $Ent);
        $sentencia->bindParam(3, $Fin);
        $sentencia->bindParam(4, $Ffi);
        $sentencia->bindParam(5, $Fca);
        $sentencia->bindParam(6, $Hor);
        $sentencia->bindParam(7, $Descripcion);
        $sentencia->bindParam(8, $dni);
        $sentencia->bindParam(9, $id);
    } else {
        $sentencia = $conexion->prepare("UPDATE Formacion_Complementaria
        SET
        Nombre = ?,
        Entidad_Emisora = ?,
        Fecha_Inicio = ?,
        Fecha_Fin = ?,
        Num_Horas = ?,
        Descripcion = ?
        WHERE DNI_CIF = ? AND Id_Formacion_Complementaria = ? ");

        $sentencia->bindParam(1, $Nom);
        $sentencia->bindParam(2, $Ent);
        $sentencia->bindParam(3, $Fin);
        $sentencia->bindParam(4, $Ffi);
        $sentencia->bindParam(5, $Hor);
        $sentencia->bindParam(6, $Descripcion);
        $sentencia->bindParam(7, $dni);
        $sentencia->bindParam(8, $id);
    }


    try {
        $sentencia->execute();
        header("Location: ../index.php#Formacion_complementaria");

    } catch (PDOException $e) {
        echo $Nom;
        echo "<br>";
        echo $Ent;
        echo "<br>";
        echo $Fin;
        echo "<br>";
        echo $Ffi;
        echo "<br>";
        echo $Fca;
        echo "<br>";
        echo $Hor;
        echo "<br>";
        echo $id;
        echo "<br>";
        echo $dni;
    }
    ?>
</body>

</html>
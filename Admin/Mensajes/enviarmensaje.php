<?php 
    include "../../Funciones/conexion.php";
    $dni_origen=$_SESSION['dni'];
    $dni_destino=$_POST['dni_destino'];
    $mensaje = $_POST['mensaje'];
    $processed_input = htmlspecialchars($mensaje);
     

    if ($dni_origen!=$dni_destino){
        $sql_nombre_destino = "SELECT Nombre_Usuario FROM `Usuario` WHERE DNI_CIF='$dni_origen'";
        $resultado_nombre_destino = $conexion->query($sql_nombre_destino);
        while ($row_nombre_destino = $resultado_nombre_destino->fetch(PDO::FETCH_OBJ)) {
            $Nombre_destino = $row_nombre_destino->Nombre_Usuario;
        }
    
        $sentencia = $conexion->prepare("INSERT INTO Mensaje (Origen_Mensaje, Destino_Mensaje, Mensaje) VALUES (?, ?, ?)");
        $sentencia->bindParam(1, $dni_origen);
        $sentencia->bindParam(2, $dni_destino);
        $sentencia->bindParam(3, $processed_input);
    
        $sentenciados = $conexion->prepare("INSERT INTO Alertas (Alerta, DNI_CIF, Vista) VALUES (?, ?, 1)");
        $Mensaje = "📩 Tienes un nuevo mensaje de ".$Nombre_destino." (Administrador), a las ".date("h:i:sa (Y-m-d) ", mktime( date("h",$SF)+1));
        $sentenciados->bindParam(1, $Mensaje);
        $sentenciados->bindParam(2, $dni_destino);
    
    
     try {
        $sentencia->execute();
        $sentenciados->execute();
        header("Location: mensaje?enviado=true");
    } catch (PDOException $e) {
         header ('Location: mensaje');
     }
    } else {
        header("Location: mensaje?enviado=false");

    }
    
 ?>
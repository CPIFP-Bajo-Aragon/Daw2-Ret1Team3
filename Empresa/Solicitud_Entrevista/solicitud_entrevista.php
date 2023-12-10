<?php 
    include "../../Funciones/conexion.php";

    $dni_alumno=$_POST['dniAlumno'];
    $Id_Oferta=$_POST['idOferta'];
    $dni_Empresa=$_SESSION['dni'];
  


    /*Saca DNI de la empresa*/
    $sqlDNIOferas="SELECT * FROM Oferta WHERE Id_Oferta=$Id_Oferta";
    if ($resultado = $conexion->query($sqlDNIOferas)) {
        while ($fila = $resultado -> fetch(PDO::FETCH_OBJ)) {
            $Titulo_Oferta=$fila->Titulo;
        }
    }


    $sqlDNIUsuario="SELECT * FROM Usuario WHERE DNI_CIF='$dni_Empresa'";
    if ($resultado = $conexion->query($sqlDNIUsuario)) {
        while ($fila = $resultado -> fetch(PDO::FETCH_OBJ)) {
            $Nombre_empresa=$fila->Nombre_Usuario;
            $Email=$fila->Email;
        }
    }

    $sqlDNIEmpresa="SELECT * FROM Empresa WHERE DNI_CIF='$dni_Empresa'";
    if ($resultado = $conexion->query($sqlDNIEmpresa)) {
        while ($fila = $resultado -> fetch(PDO::FETCH_OBJ)) {
            $Telefono=$fila->Telefono;
        }
    }
    $Mensaje_alerta = "¡<strong>Felicidades</strong>! 🥳 La empresa <strong>$Nombre_empresa</strong> ha seleccionado tu perfil para el puesto de <strong>$Titulo_Oferta</strong>. 🌟 Te invitamos a ponerte en contacto con ellos a través del chat, su correo electrónico (<strong>$Email</strong>), o llamándolos al número de teléfono (<strong>$Telefono</strong>). 📞 ¡<strong>Mucha suerte</strong> en este emocionante proceso! 🍀";
    $Mensaje = "¡Felicidades! La empresa $Nombre_empresa ha seleccionado tu perfil para el puesto de $Titulo_Oferta. Te invitamos a ponerte en contacto con ellos a través del chat, su correo electrónico ($Email), o llamándolos al número de teléfono ($Telefono). ¡Mucha suerte en este emocionante proceso!";
    $sentenciados = $conexion->prepare("INSERT INTO Alertas (Alerta, DNI_CIF, Vista) VALUES (?, ?, 1)");
    $sentenciados->bindParam(1, nl2br($Mensaje_alerta));
    $sentenciados->bindParam(2, $dni_alumno);

    $sentencia = $conexion->prepare("INSERT INTO Mensaje (Origen_Mensaje, Destino_Mensaje, Mensaje) VALUES (?, ?, ?)");
    $sentencia->bindParam(1, $dni_Empresa);
    $sentencia->bindParam(2, $dni_alumno);
    $sentencia->bindParam(3, $Mensaje);


 try {
        $sentencia->execute();
        $sentenciados->execute();
        header("Location: ../Mis_Ofertas/ofertas.php");
    } catch (PDOException $e) {
         header ('Location: ../Mis_Ofertas/ofertas.php');
}
 









?>
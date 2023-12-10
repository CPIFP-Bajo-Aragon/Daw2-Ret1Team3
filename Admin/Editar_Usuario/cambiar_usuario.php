<?php
include "../../Funciones/conexion.php";
?>
<?php
$nombre=$_POST['nombreUser'];
$apellido=$_POST['apellidoUser'];
$telefono=$_POST['telUser'];
$direccion=$_POST['direccUser'];
$dniUser=$_POST['dniUser'];
$fnacimiento=$_POST['fnacUser'];
$idmunicipio=$_POST['municipios'];
$ppublico=$_POST['ppublicoUser'];
$movilidad=$_POST['movilidadUser'];
$coche=$_POST['cocheUser'];

$sentencia = $conexion->prepare("UPDATE Alumno
            SET
            Apellido = ?,
            Fecha_Nacimiento = ?,
            Telefono_Alumno = ?,
            Movilidad = ?,
            Direccion = ?,
            Perfil_Publico = ?,
            Id_Municipio = ?,
            Coche = ?
            WHERE DNI_CIF = ?");
    
            $sentencia->bindParam(1, $apellido);
            $sentencia->bindParam(2, $fnacimiento);
            $sentencia->bindParam(3, $telefono);
            $sentencia->bindParam(4, $movilidad);
            $sentencia->bindParam(5, $direccion);
            $sentencia->bindParam(6, $ppublico);
            $sentencia->bindParam(7, $idmunicipio);
            $sentencia->bindParam(8, $coche);
            $sentencia->bindParam(9, $dniUser);

$sentencia1 = $conexion->prepare("UPDATE Usuario
            SET
            Nombre_Usuario = ?
            WHERE DNI_CIF = ?");

            $sentencia1->bindParam(1, $nombre);
            $sentencia1->bindParam(2, $dniUser);


            try{
                $sentencia->execute();
                $sentencia1->execute();
                header("Location: index.php?resultado=true");
                

            }catch(PDOException $e){
                header("Location: index.php?resultado=false");
                
                echo "error";
            }

?>


<?php
include "../../Funciones/conexion.php";
?>
<?php
$empresa=$_POST['empresa'];
$ntrabaja=$_POST['ntrabaja'];
$web=$_POST['web'];
$tel=$_POST['tel'];
$area=$_POST['areaneg'];
$desc=$_POST['desc'];
$dirr=$_POST['dirr'];
$municipios=$_POST['municipios'];
$pais=$_POST['pais'];
$dniEmpresa=$_POST['dniEmpresa'];

$sentencia = $conexion->prepare("UPDATE Empresa
            SET
            Numero_Trabajadores = ?,
            Web = ?,
            Telefono = ?,
            Area_Negocio = ?,
            Descripcion = ?,
            Direccion = ?,
            Id_Municipio = ?,
            Pais = ?
            WHERE DNI_CIF = ?");
    
            $sentencia->bindParam(1, $ntrabaja);
            $sentencia->bindParam(2, $web);
            $sentencia->bindParam(3, $tel);
            $sentencia->bindParam(4, $area);
            $sentencia->bindParam(5, $desc);
            $sentencia->bindParam(6, $dirr);
            $sentencia->bindParam(7, $municipios);
            $sentencia->bindParam(8, $pais);
            $sentencia->bindParam(9, $dniEmpresa);

$sentencia1 = $conexion->prepare("UPDATE Usuario
            SET
            Nombre_Usuario = ?
            WHERE DNI_CIF = ?");

            $sentencia1->bindParam(1, $empresa);
            $sentencia1->bindParam(2, $dniEmpresa);


            try{
                $sentencia->execute();
                $sentencia1->execute();
                header("Location: index.php?resultado=true");
            }catch(PDOException $e){
                header("Location: index.php?resultado=false");
            }

?>


<?php
session_start();
include "../../../Funciones/conexion.php";
$dni=$_SESSION['DNI_CIF'];
$id = $_POST['id'];
$query = "SELECT * FROM Experiencia_Laboral WHERE Alumno.DNI_CIF=Experiencia_Laboral.DNI_CIF and DNI_CIF = $dni";


$resultado = $conexion->query($query);
while ($row = $resultado->fetch(PDO::FETCH_OBJ)) {
        $nombre_empresa = $row->Nombre_empresa;
        $puesto = $row->Puesto;
        $descripcion = $row->Descripcion;
        $fecha_inicio = $row->Fecha_Inicio;
        $fecha_fin = $row->Fecha_Fin;

}


?>  
    <form action="editar.php" method="POST">
        <input type="text" name="id" id="id" value="<?php echo  $id ?>" style="display:none">
        Nombre Empresa: <input type="text" name="Nombre_Empresa" id="nombre_Empresa" value="<?php echo  $nombre_empresa ?>">
        Puesto: <input type="text" name="puesto" id="puesto" value="<?php echo  $puesto ?>">
        Descripcion: <input type="text" name="descripcion" id="descripcion" value="<?php echo  $descripcion ?>">
        Fecha Inicio: <input type="text" name="fecha_inicio" id="fecha_inicio" value="<?php echo  $fecha_inicio ?>">
        Fecha Fin: <input type="text" name="fecha_fin" id="fecha_fin" value="<?php echo  $fecha_fin ?>">
        <input type="submit" value="Editar Experiencia Laboral">
    </form> 

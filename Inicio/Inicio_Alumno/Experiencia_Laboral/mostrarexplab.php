<?php
include "../../../Funciones/conexion.php";
session_start();
$dni=$_SESSION['DNI_CIF'];
echo "  <table>
        
<tr>
    <th>Nombre Empresa</th>
    <th>Puesto</th> 
    <th>Descripcion</th>
    <th>Fecha Inicio</th>
    <th>Fecha Fin</th>
    <th>Borrar</th>
    <th>Editar</th> 
</tr>   ";
$query= "SELECT * FROM Experiencia_Laboral, Alumno WHERE Alumno.DNI_CIF=Experiencia_Laboral.DNI_CIF and DNI_CIF=$dni";
$numfilas=$query->rowCount;
if($numfilas>0){


if ($resultado = $conexion->query($query)) {

    while ($row = $resultado->fetch(PDO::FETCH_OBJ)) {
        $id=$row->ID_explaboral;
        $nombre_empresa  = $row->Nombre_empresa ;
        $puesto = $row->Puesto;
        $descripcion = $row->Descripcion;
        $fecha_inicio = $row->Fecha_Inicio;
        $fecha_fin = $row->Fecha_Fin;

        echo 
        '<tr> 
        <td>'.htmlspecialchars($nombre_empresa, ENT_QUOTES, 'UTF-8').'</td> 
        <td>'.htmlspecialchars($puesto, ENT_QUOTES, 'UTF-8').'</td> 
        <td>'.htmlspecialchars($descripcion, ENT_QUOTES, 'UTF-8').'</td> 
        <td>'.$fecha_inicio.'</td> 
        <td>'.$fecha_fin.'</td> 
        <td>
            <form action="ediatexplab.php" method="POST">
                <input type="text" name="id" id="id" value="' .$id. '" style="display:none";>
                <input type="submit" value="Editar">
            </form>
        
            <form action="borrarexplab.php" method="POST">
                <input type="text" name="id" id="id" value="' .$id. '" style="display:none";>
                <input type="submit" value="Borrar">
            </form>
        </td>
        </tr>';
    }

}
echo' </table>';

}else{
    ?>
    <form action="Experiencia_Laboral/mostrarexplab.php" method="POST">
    <input type="submit" name="insertar" value="Añadir Experiencia Laboral">
    </form>
    <?php
}


if(isset($_POST['insertar'])){
    ?>
    <form action="Experiencia_Laboral/mostrarexplab.php" method="POST">
    Nombre Empresa: <input type="text" name="nombre_empresa" id="nombre_empresa">
    Puesto: <input type="text" name="puesto" id="puesto">
    Descripcion: <input type="text" name="descripcion" id="descripcion">
    Fecha Inicio: <input type="text" name="fecha_inicio" id="fecha_inicio">
    Fecha Fin: <input type="text" name="fecha_fin" id="fecha_fin">
               <input type="submit" name="insertar2" value="Añadir Experiencia Laboral">
</form>
<?php
}

if(isset($_Post['insertar2'])){
$nombre_empresa = $_POST['nombre_empresa'];
$puesto = $_POST['puesto'];
$descripcion = $_POST['descripcion'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$dni=$_SESSION['DNI_CIF'];
$sentencia = $conexion->prepare("INSERT INTO Experiencia_Laboral (Nombre_empresa, Puesto, Descripcion, Fecha_Inicio, Fecha_Fin, DNI_CIF) VALUES (?, ?, ?, ?, ?, ?)");
$sentencia->bindParam(1, $nombre_empresa);
$sentencia->bindParam(2, $puesto);
$sentencia->bindParam(3, $descripcion);
$sentencia->bindParam(4, $fecha_inicio);
$sentencia->bindParam(5, $fecha_fin);
$sentencia->bindParam(6, $dni);

try {
    $sentencia->execute();
    echo "Experiencia laboral añadida exitosamente";

} catch (PDOException $e) {
    echo "Error al añadir la experiencia laboral";
    
}

}



?>
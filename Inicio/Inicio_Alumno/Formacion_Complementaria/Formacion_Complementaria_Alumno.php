<?php include "../../Funciones/conexion.php";
?>
<link rel="stylesheet" href="../../Estilos/Formacion_Complementaria_Alumno.css">
<script src="../../Funciones/ocultardiv.js"></script>

<script>
function validarFechas() {

    var fechaInicio = new Date(document.getElementsByName("Fecha_Inicio")[0].value);
    var fechaFin = new Date(document.getElementsByName("Fecha_Fin")[0].value);

    if (fechaFin <= fechaInicio) {
        alert("La Fecha de Fin debe ser posterior a la Fecha de Inicio.");
        return false;
    }
    return true;
}
</script>

<?php



$dni = $_SESSION['dni'];
$sql = "SELECT * FROM Formacion_Complementaria WHERE DNI_CIF='$dni'";   






if ($resultado = $conexion->query($sql)) {
    while ($row = $resultado->fetch(PDO::FETCH_OBJ)) {
        $Id_Formacion = $row -> Id_Formacion_Complementaria;
        $Nombre_Complementaria = $row->Nombre;
        $Fecha_Inicio = $row->Fecha_Inicio;
        $Fecha_Fin = $row->Fecha_Fin;
        $Fecha_Caducidad = $row->Fecha_Caducidad;
        $Num_Horas = $row->Num_Horas;
    }
    
}
    if(isset($_POST['Editar'])){
        $id=$_POST['id_Formacion'];
        $Nombre = $_POST['Nombre'];
        $Entidad_emisora =$_POST['Entidad_emisora'];
        $Fecha_Inicio = $_POST['Fecha_Inicio'];
        $Fecha_Fin = $_POST['Fecha_Fin'];
        $Fecha_Caducidad = $_POST['Fecha_Caducidad'];
        $Num_Horas = $_POST['Num_Horas'];
      
        ?>
<style>
#nomostar {
    display: none;
}
</style>

<form method="POST" action="Formacion_Complementaria/editarFormacion.php">
    <label for="Nombre">Nombre:</label>
    <input type="text" name="Nombre" value="<?php echo $Nombre?>"><br>

    <label for="Entidad_emisora">Entidad emisora:</label>
    <input type="text" name="Entidad_Emisora" value="<?php echo $Entidad_emisora?>"><br>

    <label for="Fecha_Inicio">Fecha_Inicio:</label>
    <input type="date" name="Fecha_Inicio" id="Fecha_Inicio"" value=" <?php echo $Fecha_Inicio?>"><br>

    <label for="Fecha_Fin">Fecha_Fin:</label>
    <input type="date" name="Fecha_Fin" id="Fecha_Fin" value="<?php echo $Fecha_Fin?>"><br>

    <label for="Fecha_Caducidad">Fecha_Caducidad:</label>
    <input type="date" name="Fecha_Caducidad" value="<?php echo $Fecha_Caducidad?>"><br>

    <label for="Num_Horas">NumHoras:</label>
    <input type="text" name="Num_Horas" value="<?php echo $Num_Horas?>" pattern="[0-9]+"><br>

    <input type="hidden" name="id_Formacion" value="<?php echo $id?>">

    <input type="submit" name="AñadirFormacion" value="Realizar Cambios">

</form>
<?php
    }

?>


<form method="POST" action="Formacion_Complementaria/añadirFormacion.php" id="nomostar">
    <label for="Nombre">Nombre:</label>
    <input type="text" name="Nombre" value="" required>

    <label for="Entidad_emisora">Entidad emisora:</label>
    <input type="text" name="Entidad_Emisora" required>

    <label for="Fecha_Inicio">Fecha_Inicio:</label>
    <input type="date" name="Fecha_Inicio" required>

    <label for="Fecha_Fin">Fecha_Fin:</label>
    <input type="date" name="Fecha_Fin" required>

    <label for="Fecha_Caducidad">Fecha_Caducidad:</label>
    <input type="date" name="Fecha_Caducidad">

    <label for="Num_Horas">NumHoras:</label>
    <input type="text" name="Num_Horas" required pattern="[0-9]+">

    <input type="submit" name="AñadirFormacion" value="Añadir Formacion">
</form>

<br>
<hr>

<table>
    <tr>
        <th>Nombre </th>
        <th>Entidad emisora</th>
        <th>Fecha Inicio</th>
        <th>Fecha_Fin</th>
        <th>Fecha_Caducidad</th>
        <th>Horas</th>
        <th>Acciones</th>
    </tr>

    <?php 


$query="SELECT * FROM Formacion_Complementaria where DNI_CIF='$dni'" ;
if ($result = $conexion->query($query)) {
    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
        $Id_Formacion = $row -> Id_Formacion_Complementaria;
        $Nombre = $row->Nombre;
        $Entidad_emisora = $row-> Entidad_Emisora;
        $Fecha_Inicio =  $row-> Fecha_Inicio;
        $Fecha_Fin =  $row-> Fecha_Fin;
        $Fecha_Caducidad =  $row-> Fecha_Caducidad;
        $Num_Horas =  $row-> Num_Horas;
        
        echo " 
        <td> $Nombre</td>
        <td> $Entidad_emisora</td>
        <td> $Fecha_Inicio</td>
        <td> $Fecha_Fin</td>
        <td> $Fecha_Caducidad</td>
        <td> $Num_Horas</td>
        <td>"
        ?>
    <form action="Formacion_Complementaria/eliminarFormacion.php" method="POST">
        <input type="hidden" name="id_Formacion" id="id" value="<?php echo $Id_Formacion;?>">
        <input type="submit" value="Borrar">
    </form>

    <form action="index.php#Formacion_complementaria" method="POST">
        <input type="hidden" name="id_Formacion" value="<?php echo $Id_Formacion;?>">
        <input type="hidden" name="Nombre" value="<?php echo $Nombre;?>">
        <input type="hidden" name="Entidad_emisora" value="<?php echo $Entidad_emisora;?>">
        <input type="hidden" name="Fecha_Inicio" value="<?php echo $Fecha_Inicio;?>">
        <input type="hidden" name="Fecha_Fin" value="<?php echo $Fecha_Fin;?>">
        <input type="hidden" name="Fecha_Caducidad" value="<?php echo $Fecha_Caducidad;?>">
        <input type="hidden" name="Num_Horas" value="<?php echo $Num_Horas;?>">
        <input type="submit" name="Editar" value="Editar">
    </form>
    <?php
        echo"
        </td>";
        echo "</tr>";
        
        
        
    }

}
?>

</table>
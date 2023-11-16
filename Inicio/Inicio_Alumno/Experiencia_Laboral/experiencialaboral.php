<?php 
include "../../Funciones/conexion.php";
include "../../Funciones/SessionStart.php";
?>
<link rel="stylesheet" href="../../../Estilos/curriculumimprimir.css">
<script src="../../Funciones/ocultardiv.js"></script>

<?php



$dni = $_SESSION['dni'];
$sql = "SELECT * FROM Experiencia_Laboral WHERE DNI_CIF='$dni'";   


if ($resultado = $conexion->query($sql)) {
    while ($row = $resultado->fetch(PDO::FETCH_OBJ)) {
        $Id_Explab = $row -> Id_Experiencia_Laboral;
        $Nombre_Complementaria = $row->Nombre_Empresa;
        $Descripcion = $row->Descripcion;
        $Fecha_Inicio = $row->Fecha_Inicio;
        $Fecha_Fin = $row->Fecha_Fin;
    }
    
}
    if(isset($_POST['Editar'])){
        $id=$_POST['id'];
        $Nombre = $_POST['Nombre'];
        $Puesto=$_POST['Puesto'];
        $Descripcion=$_POST['Descripcion'];
        $Fecha_Inicio = $_POST['Fecha_Inicio'];
        $Fecha_Fin = $_POST['Fecha_Fin'];
      
        ?>
        <style>
        #nomostar{
            display: none;
        }
         </style>

        <form action="Experiencia_Laboral/editar.php" method="POST">

        <input type="hidden" name="id" id="id" value="<?php echo $id;?>">

            <label for="Nombre">Nombre Empresa:</label>
            <input type="text" name="Nombre" value="<?php echo $Nombre?>">

            <label for="Puesto">Puesto:</label>
            <input type="text" name="Puesto" value="<?php echo $Puesto?>">

            <label for="descripcion">Descripcion:</label>
            <input type="text" name="Descripcion" value="<?php echo $Descripcion?>">

            <label for="Fecha_Inicio">Fecha_Inicio:</label>
            <input type="date" name="Fecha_Inicio" value="<?php echo $Fecha_Inicio?>">

            <label for="Fecha_Fin">Fecha_Fin:</label>
            <input type="date" name="Fecha_Fin" value="<?php echo $Fecha_Fin?>">

            <input type="submit" name="insertarexplab" value="Realizar Cambios">
            
        </form>
        <?php
    }

?>

    <form method="POST" action="Experiencia_Laboral/insertarexplab.php" id="nomostar">
        <label for="Nombre">Nombre Empresa:</label>
        <input type="text" name="Nombre" value="">

        <label for="puesto">Puesto:</label>
        <input type="text" name="Puesto">

        <label for="Descripcion">Descripcion:</label>
        <input type="text" name="Descripcion">

        <label for="Fecha_Inicio">Fecha_Inicio:</label>
        <input type="date" name="Fecha_Inicio">

        <label for="Fecha_Fin">Fecha_Fin:</label>
        <input type="date" name="Fecha_Fin">


        <input type="submit" name="insertarexplab" value="Añadir Experiencia Laboral">
    </form>
 
   

       
<table>
    <tr>
        <th>Nombre Empresa</th>
        <th>Puesto</th>
        <th>Descripcion</th>
        <th>Fecha Inicio</th>
        <th>Fecha_Fin</th>
        <th>Acción</th>
    </tr>
    
<?php     
 $query="SELECT * FROM Experiencia_Laboral WHERE DNI_CIF='$dni'";
 if ($result = $conexion->query($query)) {
     while ($row = $result->fetch(PDO::FETCH_OBJ)) {
         $id = $row -> Id_Experiencia_Laboral;
         $Nombre = $row->Nombre_Empresa;
         $Puesto = $row-> Puesto;
         $Descripcion = $row->Descripcion;
         $Fecha_Inicio =  $row-> Fecha_Inicio;
         $Fecha_Fin =  $row-> Fecha_Fin;
         
         echo " 
         <td> $Nombre</td>
         <td> $Puesto</td>
         <td> $Descripcion</td>
         <td> $Fecha_Inicio</td>
         <td> $Fecha_Fin</td>
         <td>"
         ?>
         <form action="Experiencia_Laboral/borrarexplab.php" method="POST">
             <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
             <input type="submit" value="Borrar">
         </form>
         
         <form action="index.php" method="POST">
             <input type="hidden" name="id" value="<?php echo $id;?>">
             <input type="hidden" name="Nombre" value="<?php echo $Nombre;?>">
             <input type="hidden" name="Puesto" value="<?php echo $Puesto;?>">
             <input type="hidden" name="Descripcion" value="<?php echo $Descripcion;?>">
             <input type="hidden" name="Fecha_Inicio" value="<?php echo $Fecha_Inicio;?>">
             <input type="hidden" name="Fecha_Fin" value="<?php echo $Fecha_Fin;?>">
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
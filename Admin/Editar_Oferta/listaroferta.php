<?php
include "../../Funciones/conexion.php";

if(isset($_POST['validar'])){
    $id=$_POST['id_oferta_validar'];
    $activo=1;
    
    $sentencia = $conexion->prepare("UPDATE Oferta 
    SET Activo=?
    WHERE Id_Oferta = ?");
    $sentencia->bindParam(1, $activo);
    $sentencia->bindParam(2, $id);
    try {
        $sentencia->execute();
        header("Location: index.php");

    } catch (PDOException $e) {
        echo "error";
    } 
}

if(isset($_POST['eliminar'])){
    $id=$_POST['id_oferta_eliminar'];
    $activo=2;
    
    $sentencia = $conexion->prepare("UPDATE Oferta 
    SET Activo=?
    WHERE Id_Oferta = ?");
    $sentencia->bindParam(1, $activo);
    $sentencia->bindParam(2, $id);
    try {
        $sentencia->execute();
        header("Location: index.php");
    
    } catch (PDOException $e) {
        echo "error";
    } 
}
if(isset($_POST['novalidar'])){
    $id=$_POST['id_oferta_noactivo'];
    $activo=0;
    $sentencia = $conexion->prepare("UPDATE Oferta 
    SET Activo=?
    WHERE Id_Oferta = ?");
    $sentencia->bindParam(1, $activo);
    $sentencia->bindParam(2, $id);
    try {
        $sentencia->execute();
        header("Location: index.php");
    
    } catch (PDOException $e) {
        echo "error";
    } 
}



$resultados_por_pagina = 5; 
$pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; 

$indice_inicio = ($pagina_actual - 1) * $resultados_por_pagina;
$sql = "SELECT Oferta.*, Usuario.Nombre_Usuario 
        FROM Oferta
        INNER JOIN Usuario ON Oferta.DNI_CIF = Usuario.DNI_CIF
        GROUP BY Oferta.Id_Oferta 
        LIMIT $indice_inicio, $resultados_por_pagina";

$resultado = $conexion->query($sql);
$consulta_total = "SELECT COUNT(*) AS total FROM Oferta";
$total_resultados = $conexion->query($consulta_total)->fetch(PDO::FETCH_ASSOC)['total'];
 
if ($resultado->rowCount() > 0) {   
    echo "<h1>Gestión de todas las Oferta</h1>
    <table class='validar'>
        <tr>
            <th>Empresa</th>
            <th>Nombre Oferta</th>
            <th>Vacantes</th>
            <th>Descripcion</th>
            <th>Fecha_Inicio</th>
            <th>Fecha_Fin</th>
            <th>DNI_CIF</th>
            <th>Id_Oferta</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>";

    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $idoferta = $fila['Id_Oferta'];
            $dniempresa = $fila['DNI_CIF'];
            $ofertaActivo = $fila['Activo'];
            $sqluno="SELECT * FROM 
         WHERE DNI_CIF = '$dniempresa'";

            echo "<tr>
            <td>" . $fila['Nombre_Usuario'] . "</td>
            <td>" . $fila['Titulo'] . "</td>
            <td>" . $fila['Vacantes'] . "</td>
            <td>" . $fila['Descripcion'] . "</td>
            <td>" . $fila['Fecha_Inicio'] . "</td>
            <td>" . $fila['Fecha_Fin'] . "</td>
            <td>" . $fila['DNI_CIF'] . "</td>
            <td>" . $fila['Id_Oferta'] . "</td>";
            if($ofertaActivo==0){
                echo "<td style='background-color:red;'>No Activo.</td>";
            }
            if($ofertaActivo==1){
                echo "<td style='background-color:green;'>Activo.</td>";

            }
            if($ofertaActivo==2){
                echo "<td style='background-color:brown;'>Eliminado.</td>";

            }
            if($ofertaActivo==3){
                echo "<td style='background-color:purple;'>Pendiente de validar.</td>";
            }
            
            ?>

<td class='botones'>
    <form action="editarOferta.php" method="post">
        <input type="hidden" name="Id_Oferta" id="" value="<?php echo $idoferta;?>">
        <input type="hidden" name="dniEmpresa" id="" value="<?php echo $dniempresa;?>">
        <input class="boton" id="validar1" type="submit" name="novalidar" value="✎" title="Editar">
    </form>
</td>
</tr>
<?php
            
            
            
            

            ?>

<?php
    }
    

} else {
    echo "No se encontraron resultados.";
}
echo "</table>";

$conexion = null;
    $total_paginas = ceil($total_resultados / $resultados_por_pagina);
        echo "<p>Pagina: ";
    for ($i = 1; $i <= $total_paginas; $i++) {
        echo "<a style='color: blue;' href='index.php?pagina=$i'>$i</a> ";
    }
    echo "</p>";

?>
<br>
<button onclick="confirmar()">VALIDAR TODOS LOS USUARIOS</button>
<button onclick="confirmardos()">BORRAR TODOS LOS USUARIOS</button>

<script>
function confirmar() {
    if (confirm('¿Estas seguro de lo que vas a hacer?')) {
        window.location = 'validartodos.php?result=1';
    }
}
</script>
<script>
function confirmardos() {
    if (confirm('¿Estas seguro de lo que vas a hacer?')) {
        window.location = 'borrartodos.php?result=1';
    }
}
</script>
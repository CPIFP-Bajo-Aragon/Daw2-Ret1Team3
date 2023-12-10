<?php
include "../../Funciones/conexion.php";

if(isset($_POST['validar'])){
    $id=$_POST['id_oferta_validar'];
    $dni_empresa=$_POST['dni_empresa'];

    $activo=1;
    
    $sentencia = $conexion->prepare("UPDATE Oferta 
    SET Activo=?
    WHERE Id_Oferta = ?");
    $sentencia->bindParam(1, $activo);
    $sentencia->bindParam(2, $id);
    try {

        $sentencia->execute();
        $nuevaAlerta = "✅ Oferta validada correctamente por un Administrador ";
        $vista = 1;
    
        $sentenciaInsert = $conexion->prepare("INSERT INTO Alertas (Alerta, DNI_CIF, Vista) VALUES (?, ?, ?)");
        $sentenciaInsert->bindParam(1, $nuevaAlerta);
        $sentenciaInsert->bindParam(2, $dni_empresa);
        $sentenciaInsert->bindParam(3, $vista);
        $sentenciaInsert->execute();
        header("Location: index.php");

    } catch (PDOException $e) {
        echo "error";
    } 
}

if(isset($_POST['eliminar'])){
    $id=$_POST['id_oferta_eliminar'];
    $dni_empresa=$_POST['dni_empresa'];

    $activo=2;
    
    $sentencia = $conexion->prepare("UPDATE Oferta 
    SET Activo=?
    WHERE Id_Oferta = ?");
    $sentencia->bindParam(1, $activo);
    $sentencia->bindParam(2, $id);
    try {
        $sentencia->execute();
        $nuevaAlerta = "Oferta Eliminada por un Administrador  (Si esto es un error <a target='_blank' href='../../Reportes/index.php'>contacta con un Administrador</a> para que lo reactive)";
        $vista = 1;
    
        $sentenciaInsert = $conexion->prepare("INSERT INTO Alertas (Alerta, DNI_CIF, Vista) VALUES (?, ?, ?)");
        $sentenciaInsert->bindParam(1, $nuevaAlerta);
        $sentenciaInsert->bindParam(2, $dni_empresa);
        $sentenciaInsert->bindParam(3, $vista);
        $sentenciaInsert->execute();
        header("Location: index.php");
    
    } catch (PDOException $e) {
        echo "error";
    } 
}
if(isset($_POST['novalidar'])){
    $id=$_POST['id_oferta_noactivo'];
    $dni_empresa=$_POST['dni_empresa'];

    $activo=0;
    $sentencia = $conexion->prepare("UPDATE Oferta 
    SET Activo=?
    WHERE Id_Oferta = ?");
    $sentencia->bindParam(1, $activo);
    $sentencia->bindParam(2, $id);
    try {
        $sentencia->execute();
        $nuevaAlerta = "Oferta Desactivada por un Administrador  (Si esto es un error <a target='_blank' href='../../Reportes/index.php'>contacta con un Administrador</a> para que lo reactive)";
        $vista = 1;
    
        $sentenciaInsert = $conexion->prepare("INSERT INTO Alertas (Alerta, DNI_CIF, Vista) VALUES (?, ?, ?)");
        $sentenciaInsert->bindParam(1, $nuevaAlerta);
        $sentenciaInsert->bindParam(2, $dni_empresa);
        $sentenciaInsert->bindParam(3, $vista);
        $sentenciaInsert->execute();
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
            <td>" . truncateText($fila['Descripcion'], 20) . "</td>
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
    <form action="listaroferta.php" method="post">
    <input type="hidden" name="dni_empresa" id="" value="<?php echo $dniempresa;?>">

        <input type="hidden" name="id_oferta_eliminar" id="" value="<?php echo $idoferta;?>">
        <input class="boton" id="borrar1" type="submit" name="eliminar" value="🗑️" title="Borrar Oferta">
    </form>

    <form action="listaroferta.php" method="post">
    <input type="hidden" name="dni_empresa" id="" value="<?php echo $dniempresa;?>">

        <input type="hidden" name="id_oferta_validar" id="" value="<?php echo $idoferta;?>">
        <input class="boton" id="validar1" type="submit" name="validar" value="✅" title="Validar Oferta">
    </form>

    <form action="listaroferta.php" method="post">
    <input type="hidden" name="dni_empresa" id="" value="<?php echo $dniempresa;?>">

        <input type="hidden" name="id_oferta_noactivo" id="" value="<?php echo $idoferta;?>">
        <input class="boton" id="validar1" type="submit" name="novalidar" value="🚫" title="No Validar Oferta">
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
function truncateText($text, $length) {
    if ($text === null) {
        return '';
    }
    return (strlen($text) > $length) ? substr($text, 0, $length) . '...' : $text;
}

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
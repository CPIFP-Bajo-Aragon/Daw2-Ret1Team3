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
        $nuevaAlerta = "✅ Oferta validada correctamente por un Administrador ";
        $vista = 1;
    
        $sentenciaInsert = $conexion->prepare("INSERT INTO Alertas (Alerta, DNI_CIF, Vista) VALUES (?, ?, ?)");
        $sentenciaInsert->bindParam(1, $nuevaAlerta);
        $sentenciaInsert->bindParam(2, $dni_empresa);
        $sentenciaInsert->bindParam(3, $vista);
        $sentenciaInsert->execute();
    
        $sentencia->execute();
        header("Location: index.php");
    } catch (PDOException $e) {
        echo "error";
    } 
}

if(isset($_POST['eliminar'])){
    $id=$_POST['id_oferta_eliminar'];
    $activo=2;
    $dni_empresa=$_POST['dni_empresa'];

    $sentencia = $conexion->prepare("UPDATE Oferta 
    SET Activo=?
    WHERE Id_Oferta = ?");
    $sentencia->bindParam(1, $activo);
    $sentencia->bindParam(2, $id);
    try {
        $nuevaAlerta = "❌ Tu oferta no a sido validada por un Administrador  (Si esto es un error  <a target='_blank' href='../../Reportes/index.php'>contacta con un Administrador</a> para que lo reactive)";
        $vista = 1;
    
        $sentenciaInsert = $conexion->prepare("INSERT INTO Alertas (Alerta, DNI_CIF, Vista) VALUES (?, ?, ?)");
        $sentenciaInsert->bindParam(1, $nuevaAlerta);
        $sentenciaInsert->bindParam(2, $dni_empresa);
        $sentenciaInsert->bindParam(3, $vista);
        $sentenciaInsert->execute();
        $sentencia->execute();
        header("Location: index.php");
    
    } catch (PDOException $e) {
        echo "error";
    } 
}

$resultados_por_pagina = 1; 
$pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; 

$indice_inicio = ($pagina_actual - 1) * $resultados_por_pagina;
$sql = "SELECT * FROM Oferta 
        WHERE Activo=3 
        GROUP BY Oferta.Id_Oferta 
        LIMIT $indice_inicio, $resultados_por_pagina";
$resultado = $conexion->query($sql);
$consulta_total = "SELECT COUNT(*) AS total FROM Oferta WHERE Activo=3 ";
$total_resultados = $conexion->query($consulta_total)->fetch(PDO::FETCH_ASSOC)['total'];
 
if ($resultado->rowCount() > 0) {
    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
            echo "<h3>".$fila['Titulo']."</h3>";
            echo "<hr class=\"divider\">";
            $idoferta = $fila['Id_Oferta'];
            $dniempresa = $fila['DNI_CIF'];

            $sqluno="SELECT * FROM Usuario WHERE DNI_CIF = '$dniempresa'";
            if($resultadouno = $conexion -> query($sqluno)){
                while($filauno = $resultadouno->fetch(PDO::FETCH_OBJ)){
                    echo "<p class=\"info\">Empresa: ".$filauno-> Nombre_Usuario."</p>";
                }
            }
            echo "<p class=\"info\">Vacantes: ".$fila['Vacantes']."</p>";
            echo "<p class=\"info\">Descripcion: ".$fila['Descripcion']."</p>";
            echo "<p class=\"info\">Fecha Inicio: ".$fila['Fecha_Inicio']."</p>";
            echo "<p class=\"info\">Fecha Fin: ".$fila['Fecha_Fin']."</p>";
            echo "<p class=\"info\">DNI-CIF: ".$fila['DNI_CIF']."</p>";
            echo "<p class=\"info\">Id Oferta: ".$fila['Id_Oferta']."</p>";
            ?>
            <div class="botonesOfertas">
                <form action="validar_oferta.php" method="post">
                      <input type="hidden" name="dni_empresa" id="" value="<?php echo $dniempresa;?>">
                     <input type="hidden" name="id_oferta_eliminar" id="" value="<?php echo $idoferta;?>">
                    <input class="boton"  id="borrar1" type="submit" name="eliminar" value="🗑️" title="Borrar Oferta">
                </form>
                <form action="validar_oferta.php" method="post">
                <input type="hidden" name="dni_empresa" id="" value="<?php echo $dniempresa;?>">
                    <input type="hidden" name="id_oferta_validar" id="" value="<?php echo $idoferta;?>">
                    <input class="boton" id="validar1" type="submit" name="validar" value="✅" title="Validar Oferta">
                </form>

            </div>
    <?php
    }
    $conexion = null;
    $total_paginas = ceil($total_resultados / $resultados_por_pagina);
        echo "<p>Pagina: ";
    for ($i = 1; $i <= $total_paginas; $i++) {
        echo "<a style='color: blue;' href='index.php?pagina=$i'>$i</a> ";
    }
    echo "</p>";

} else {
    echo "No se encontraron resultados.";
}

?>

<?php
include "../../Funciones/conexion.php";

$resultados_por_pagina = 10; 
$pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; 

$indice_inicio = ($pagina_actual - 1) * $resultados_por_pagina;

$consulta = "SELECT Usuario.Fecha_Registro, Usuario.DNI_CIF, Usuario.Email, Usuario.Nombre_Usuario, Numero_Trabajadores, Web, Telefono, Descripcion, Direccion 
FROM Usuario, Empresa 
WHERE Usuario.Tipo_Usuario='Empresa' AND Usuario.DNI_CIF = Empresa.DNI_CIF AND Empresa.Activo=0 
GROUP BY Usuario.DNI_CIF 
LIMIT $indice_inicio, $resultados_por_pagina";

$resultado = $conexion->query($consulta);

$consulta_total = "SELECT COUNT(*) as total FROM Usuario, Empresa WHERE Usuario.Tipo_Usuario='Empresa' AND Usuario.DNI_CIF = Empresa.DNI_CIF AND Empresa.Activo=0 GROUP BY Usuario.DNI_CIF";

$resultado_total = $conexion->query($consulta_total);
$total_resultados = 1;

if ($resultado_total->rowCount() > 0) {
    $total_resultados = $resultado_total->fetch(PDO::FETCH_ASSOC)['total'];
} 

if ($resultado->rowCount() > 0) {
    echo "<h1>Activar Empresas</h1>
    <table class='validar' border='1'>
        <tr>
            <th>DNI_CIF</th>
            <th>Email</th>
            <th>Nombre</th>
            <th>Numero_Trabajadores</th>
            <th>Web</th>
            <th>Telefono</th>
            <th>Descripcion</th>
            <th>Direccion</th>
            <th>Fecha Registro</th>
            <th>Acción</th>
        </tr>";

    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
            <td>" . $fila['DNI_CIF'] . "</td>
            <td>" . $fila['Email'] . "</td>
            <td>" . $fila['Nombre_Usuario'] . "</td>
            <td>" . $fila['Numero_Trabajadores'] . "</td>
            <td>" . $fila['Web'] . "</td>
            <td>" . $fila['Telefono'] . "</td>
            <td>" . $fila['Descripcion'] . "</td>
            <td>" . $fila['Direccion'] . "</td>
            <td>" . $fila['Fecha_Registro'] . "</td>
            <td class='botones'>
                <form action='borrarempresa.php' method='POST'>
                    <input type='hidden' name='id_dni' value='" . $fila['DNI_CIF'] . "'>
                    <input  id='borrar2' class='boton' type='submit' name='borrar' value='🗑️' title='Borrar Empresa'>
                </form>
                <form action='validarempresa.php' method='POST'>
                    <input type='hidden' name='id_dni' value='" . $fila['DNI_CIF'] . "'>
                    <input id='validar2' class='boton' type='submit' name='validar' value='✅' title='Validar Empresa'>
                </form>
            </td>
          </tr>";
    }
} else {
    echo "<p>No se encontraron resultados.</p><br>";
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
<button onclick="confirmar()">VALIDAR TODAS LAS EMPRESAS</button>
<button onclick="confirmardos()">BORRAR TODAS LAS EMPRESAS</button>

<script> 
function confirmar(){ 
    if(confirm('¿Estás seguro de lo que vas a hacer?')){
        window.location = 'validartodos.php?result=1';
    }
}
</script>
<script> 
function confirmardos(){ 
    if(confirm('¿Estás seguro de lo que vas a hacer?')){
        window.location = 'borrartodos.php?result=1';
    }
}
</script>

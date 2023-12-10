<?php
include "../../Funciones/conexion.php";

$resultados_por_pagina = 10; 
$pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; 

$indice_inicio = ($pagina_actual - 1) * $resultados_por_pagina;

$consulta = "SELECT Activo, Usuario.Fecha_Registro, Usuario.DNI_CIF, Usuario.Email, Usuario.Nombre_Usuario, Numero_Trabajadores, Web, Telefono, Descripcion, Direccion 
FROM Usuario, Empresa 
WHERE Usuario.Tipo_Usuario='Empresa' AND Usuario.DNI_CIF = Empresa.DNI_CIF 
GROUP BY Usuario.DNI_CIF 
ORDER BY Activo
LIMIT $indice_inicio, $resultados_por_pagina";

$resultado = $conexion->query($consulta);

$consulta_total = "SELECT COUNT(*) as total FROM Usuario, Empresa WHERE Usuario.Tipo_Usuario='Empresa' AND Usuario.DNI_CIF = Empresa.DNI_CIF";

$resultado_total = $conexion->query($consulta_total);
$total_resultados = 1;

$total_resultados = $resultado_total->fetch(PDO::FETCH_ASSOC)['total'];

if ($resultado->rowCount() > 0) {
    echo "<h1>Gestión de todas las Empresas</h1>
    <table class='validar'>
        <tr>
            <th>NIF CIF</th>
            <th>Email</th>
            <th>Nombre</th>
            <th>Trabajadores</th>
            <th>Web</th>
            <th>Teléfono</th>
            <th>Descripción</th>
            <th>Dirección</th>
            <th>Fecha Registro</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>";

    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
            <td>" . $fila['DNI_CIF'] . "</td>
            <td>" . $fila['Email'] . "</td>
            <td>" . $fila['Nombre_Usuario'] . "</td>
            <td>" . truncateText($fila['Numero_Trabajadores'], 20) . "</td>
            <td>" . truncateText($fila['Web'], 20) . "</td>
            <td>" . truncateText($fila['Telefono'], 20) . "</td>
            <td class='truncatable' onclick='showFullInfo(this)' title='Click to show full info'>" . truncateText($fila['Descripcion'], 20) . "</td>
            <td>" . truncateText($fila['Direccion'], 20) . "</td>
            <td>" . $fila['Fecha_Registro'] . "</td>";

        if ($fila['Activo'] == 0) {
            echo "<td style='background-color:red;'>Desactivado</td>";
        } else if ($fila['Activo'] == 1) {
            echo "<td style='background-color:green;'>Activo</td>";
        } else {
            echo "<td style='background-color:brown;'>Borrado</td>";
        }

        echo " 
            <td class='botones'>
                <form action='desactivarempresa.php' method='POST'>
                    <input type='hidden' name='id_dni' value='" . $fila['DNI_CIF'] . "'>
                    <button id='desactivar1' class='boton2' type='submit' name='borrar' title='Desactivar Empresa'>🚫</button>
                </form>
                <form action='borrarempresa.php' method='POST'>
                    <input type='hidden' name='id_dni' value='" . $fila['DNI_CIF'] . "'>
                    <button id='borrar4' class='boton2' type='submit' name='borrar' title='Borrar Empresa'>🗑️</button>
                </form>
                <form action='validarempresa.php' method='POST'>
                    <input type='hidden' name='id_dni' value='" . $fila['DNI_CIF'] . "'>
                    <button id='validar4' class='boton2' type='submit' name='validar' title='Validar Empresa'>✅</button>
                </form>
            </td>
          </tr>";
    }
} else {
    echo "<p>No se encontraron resultados.</p><br>";
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
echo "<p>Página: ";
for ($i = 1; $i <= $total_paginas; $i++) {
    echo "<a style='color: blue;' href='index.php?pagina=$i'> $i, </a>";
}
echo "</p>";
?>
<button onclick="confirmar()">ACTIVAR TODAS LAS EMPRESAS</button>
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
<script>
function showFullInfo(element) {
    if (element.classList.contains('truncated')) {
        element.classList.remove('truncated');
    } else {
        element.classList.add('truncated');
    }
}
</script>



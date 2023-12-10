<?php
include "../../Funciones/conexion.php";

$resultados_por_pagina = 10; 
$pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; 

$indice_inicio = ($pagina_actual - 1) * $resultados_por_pagina;

    // Consulta SQL con LIMIT para la paginación
    $consulta = "SELECT Activo, Usuario.Fecha_Registro, Usuario.DNI_CIF, Usuario.Email, Usuario.Nombre_Usuario, Apellido, Fecha_Nacimiento, Telefono_Alumno, Movilidad, Direccion, Coche FROM Usuario, Alumno WHERE Usuario.Tipo_Usuario='Alumno' and Usuario.DNI_CIF = Alumno.DNI_CIF  group by Usuario.DNI_CIF ORDER BY Activo
    LIMIT $indice_inicio, $resultados_por_pagina " ;

    $resultado = $conexion->query($consulta);

    // Obtener el total de resultados
    $consulta_total = "SELECT COUNT(DISTINCT Usuario.DNI_CIF) as total FROM Usuario, Alumno WHERE Usuario.Tipo_Usuario='Alumno' and Usuario.DNI_CIF = Alumno.DNI_CIF";

    $resultado_total = $conexion->query($consulta_total);
    $total_resultados=1;
    $total_resultados = $resultado_total->fetch(PDO::FETCH_ASSOC)['total'];


        

        if ($resultado->rowCount() > 0 and $consulta_total>0) {

echo "<h1>Activar Usuarios</h1>
<table class='validar' border='1'>
        <tr>
            <th>DNI CIF</th>
            <th>Email</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Fecha Nacimiento</th>
            <th>Direccion</th>
            <th>Telefono</th>
            <th>Movilidad</th>
            <th>Coche</th>
            <th>Fecha Registro</th>
            <th>Estado</th>

            <th>Acción</th>
        </tr>";
    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
        // Imprimir los resultados como desees
        echo "<tr>
            <td>" . $fila['DNI_CIF'] . "</td>
            <td>" . $fila['Email'] . "</td>
            <td>" . $fila['Nombre_Usuario'] . "</td>
            <td>" . $fila['Apellido'] . "</td>
            <td>" . $fila['Fecha_Nacimiento'] . "</td>
            <td>" . $fila['Direccion'] . "</td>
            <td>" . $fila['Telefono_Alumno'] . "</td>
        "; if ($fila['Movilidad'] == 0){
            echo "<td>No</td>";
        } else {
            echo "<td>Si</td>";
        }
        if ($fila['Coche']  == 0){
            echo "<td>No</td>";
        } else {
            echo "<td>Si</td>";
        }
           echo" <td>" . $fila['Fecha_Registro'] . "</td>";
           if  ($fila['Activo'] == 0){
               echo "<td style='background-color:red;'>Desactivado</td>";
           } else if ($fila['Activo'] == 1){
               echo "<td style='background-color:green;'>Activo</td>";
           } else {
               echo "<td style='background-color:brown;'>Borrado</td>";
           }
           
           echo " 
           <td class='botones'>
                <form action='desactivarusuarios.php' method='POST'>
                <input type='hidden' name='id_dni' value='" . $fila['DNI_CIF'] . "'>
                <input id='desactivar' class='boton' type='submit' name='validar' value='🚫' title='Desactivar Usuario'>
                </form>
                <form action='borrarusuario.php' method='POST'>
                    <input type='hidden' name='id_dni' value='" . $fila['DNI_CIF'] . "'>
                    <input  id='borrar3'class='boton' type='submit' name='borrar' value='🗑️' title='Borrar Usuario'>
                </form>
            <form action='validarusuario.php' method='POST'>
                    <input type='hidden' name='id_dni' value='" . $fila['DNI_CIF'] . "'>
                    <input id='validar3' class='boton' type='submit' name='validar' value='✅' title='Validar Usuario'>
            </form>
           

            </td>
          </tr>";
    }
} else {
    echo "<p>No se encontraron resultados.</p><br>";
}
echo "</table>";
// Cerrar la conexión
$conexion = null;

// Mostrar enlaces de paginación
$total_paginas = ceil($total_resultados / $resultados_por_pagina);
echo "<p>Paginacion: ";
for ($i = 1; $i <= $total_paginas; $i++) {
    echo "<a style='color: blue;' href='index.php?pagina=$i'>$i</a> ";
}
echo "</p>";
?>
<br>
<button onclick="confirmar()">VALIDAR TODOS LOS USUARIOS</button>
<button onclick="confirmardos()">BORRAR TODOS LOS USUARIOS</button>

<script> 
function confirmar(){ 
if(confirm('¿Estas seguro de lo que vas a hacer?')){
          window.location = 'validartodos.php?result=1';
     }
}
</script>
<script> 
function confirmardos(){ 
if(confirm('¿Estas seguro de lo que vas a hacer?')){
          window.location = 'borrartodos.php?result=1';
     }
}
</script>

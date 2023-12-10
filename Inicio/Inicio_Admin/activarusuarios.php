<?php
include "../../Funciones/conexion.php";

$resultados_por_pagina = 10; 
$pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; 

$indice_inicio = ($pagina_actual - 1) * $resultados_por_pagina;

// Consulta SQL con LIMIT para la paginación
$consulta = "SELECT Usuario.DNI_CIF, Usuario.Email, Usuario.Nombre_Usuario, Usuario.Fecha_Registro FROM Usuario,Alumno WHERE Tipo_Usuario='Alumno' and Alumno.DNI_CIF=Usuario.DNI_CIF and Alumno.Activo=0 LIMIT $indice_inicio, $resultados_por_pagina";

$resultado = $conexion->query($consulta);

// Obtener el total de resultados
$consulta_total = "SELECT COUNT(*) as total FROM Usuario WHERE Tipo_Usuario='Alumno'";
$total_resultados = $conexion->query($consulta_total)->fetch(PDO::FETCH_ASSOC)['total'];

// Mostrar resultados
if ($resultado->rowCount() > 0) {
    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
        // Imprimir los resultados como desees
        echo "DNI_CIF: " . $fila['DNI_CIF'] . ", Email: " . $fila['Email'] . ", Nombre: " . $fila['Nombre_Usuario'] . ", Fecha Registro: " . $fila['Fecha_Registro'] . "<input type='submit' value='Validar'>"."<br>";
    }
} else {
    echo "No se encontraron resultados.";
}

// Cerrar la conexión
$conexion = null;

// Mostrar enlaces de paginación
$total_paginas = ceil($total_resultados / $resultados_por_pagina);

for ($i = 1; $i <= $total_paginas; $i++) {
    echo "<a href='activarusuarios.php?pagina=$i'>$i</a> ";
}
?>
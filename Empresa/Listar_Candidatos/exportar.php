<?php
include "../../Funciones/conexion.php";
$titulacion=$_POST['titulacion'];
$query = $conexion->query("SELECT * FROM Usuario, Alumno, titulacion_centro_persona  WHERE Usuario.DNI_CIF = Alumno.DNI_CIF AND Activo=1 AND Perfil_Publico=1 AND Id_Tipo_Titulacion=$titulacion  ");

if ($query) {
    $rowCount = $query->rowCount();

    if ($rowCount > 0) {
        $delimiter = ",";
        $filename = "members_" . date('Y-m-d') . ".csv";

        $f = fopen('php://memory', 'w');

        $fields = array('DNI_CIF', 'Email', 'Nombre_Usuario', 'Alumno', 'Fecha_Nacimiento', 'Telefono_Alumno', 'Direccion', 'Movilidad', 'Coche', 'Status');
        fputcsv($f, $fields, $delimiter);

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $status = isset($row['status']) ? ($row['status'] == '1' ? 'Active' : 'Inactive') : '';
            $alumno = isset($row['Alumno']) ? $row['Alumno'] : '';

            $lineData = array(
                $row['DNI_CIF'],
                $row['Email'],
                $row['Nombre_Usuario'],
                $alumno,
                $row['Fecha_Nacimiento'],
                $row['Telefono_Alumno'],
                $row['Direccion'],
                $row['Movilidad'],
                $row['Coche'],
                $status
            );
            fputcsv($f, $lineData, $delimiter);
        }

        fseek($f, 0);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        fpassthru($f);
    }
} else {
    echo "Query failed.";
}

exit;
?>


<table>
    <tr>
        <th>Nombre </th>
        <th>Email</th>
        <th>Mensaje</th>
    </tr>
<?php
include "../../Funciones/conexion.php";
    $sql="SELECT * from Reporte where Solucionado=1";

    if ($result = $conexion->query($sql)) {
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $id_reporte=$row->Id_Reporte;
            $nombre = htmlspecialchars($row->Nombre_Completo, ENT_QUOTES, 'UTF-8');
            $correo = htmlspecialchars($row->Email, ENT_QUOTES, 'UTF-8');
            $mensaje = htmlspecialchars($row->Mensaje, ENT_QUOTES, 'UTF-8');
        

            echo " 
                <td> $nombre</td>
                <td> $correo</td>
                <td> $mensaje</td>
            <td>
            <form action='actualizar.php' method='Post'>
            <input type='hidden' name=id value=$id_reporte>
            <input type='submit' value='Solucionado'>
            </form>
            </td>
            </td>
            </tr>
            ";
 
        }
    }
    ?>
    </tr>
</table>


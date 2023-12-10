<?php include "../../Funciones/conexion.php";?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>

<body>

    <?php

$dni = $_SESSION['dni'];

$query = "SELECT Centro.Nombre_Centro, Centro.Id_Centro, Titulacion_Centro_Persona.Fecha_Inicio, Titulacion_Centro_Persona.Fecha_Fin, Titulacion.Nombre, Titulacion.Id_Tipo_Titulacion FROM Centro, Alumno, Titulacion, Titulacion_Centro_Persona WHERE Centro.Id_Centro = Titulacion_Centro_Persona.Id_Centro AND Alumno.DNI_CIF = Titulacion_Centro_Persona.DNI_CIF AND Titulacion.Id_Tipo_Titulacion = Titulacion_Centro_Persona.Id_Tipo_Titulacion AND Alumno.DNI_CIF = :dni";

$stmt = $conexion->prepare($query);
$stmt->bindParam(':dni', $dni);
$stmt->execute();

if ($stmt->rowCount() > 0) {  // Verificar si hay resultados
    echo '<table>
          <tr>
            <th>Nombre del Centro</th>
            <th>Fecha de Inicio</th>
            <th>Fecha de Fin</th>
            <th>Nombre de la Titulación</th>
            <th>Acciones</th>
          </tr>';

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $Id_Centro = $row['Id_Centro'];
        $Id_Tipo_Titulacion = $row['Id_Tipo_Titulacion'];
        $Fecha_Inicio = $row['Fecha_Inicio'];

        echo '<tr>';
        echo '<td>' . $row['Nombre_Centro'] . '</td>';
        echo '<td>' . $row['Fecha_Inicio'] . '</td>';
        echo '<td>' . $row['Fecha_Fin'] . '</td>';
        echo '<td>' . $row['Nombre'] . '</td>';
        ?>
    <td>
        <button class="papelera"
            onclick="showModal4('<?php echo $Id_Centro; ?>', '<?php echo $Id_Tipo_Titulacion; ?>')">🗑️</button>
    </td>
    <form id='formulario4' action="Titulaciones/eliminarTitulaciones.php" method="POST">
        <input type="hidden" id="Id_Centro" name="Id_Centro" value=<?php echo $Id_Centro; ?>>
        <input type="hidden" id="Id_Tipo_Titulacion" name="Id_Tipo_Titulacion" value=<?php echo $Id_Tipo_Titulacion; ?>>
        <input type="hidden" id="confirmacionEliminacion4" name="confirmacionEliminacion4" value="false">

        <div class="modal4" id="myModal4">
            <div id="modal-content4" class="modal-content4"></div>
        </div>

        <script>
        function showModal4(Id_Centro, Id_Tipo_Titulacion) {
            var modal = document.getElementById('myModal4');
            modal.style.display = 'block';

            document.getElementById('modal-content4').innerHTML =
                "<p>¿Estás seguro que quieres eliminarlo?</p>" +
                "<button class='abrir' onclick=\"confirmar4('" + Id_Centro + "', '" + Id_Tipo_Titulacion +
                "')\">Confirmar</button>" +
                "<button id=cerrar class=cerrar2 onclick=hideModal4()>Cancelar</button>"
        }

        function hideModal4() {
            var modal = document.getElementById('myModal4');
            modal.style.display = 'none';
        }

        function confirmar4(Id_Centro, Id_Tipo_Titulacion) {
            document.getElementById('Id_Centro').value = Id_Centro;
            document.getElementById('Id_Tipo_Titulacion').value = Id_Tipo_Titulacion;
            document.getElementById('confirmacionEliminacion4').value = "true";
            document.getElementById('formulario4').submit();
        }
        </script>
    </form>

    <?php
    }

    echo '</tr></table><br>';
} else {
    echo "<p>Aún no has agregado ninguna titulación.</p>";
}
?>

</body>

</html>
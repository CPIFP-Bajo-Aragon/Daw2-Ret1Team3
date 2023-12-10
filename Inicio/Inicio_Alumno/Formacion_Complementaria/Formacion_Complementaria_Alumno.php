<?php include "../../Funciones/conexion.php";?>
<link rel="stylesheet" href="../../Estilos/Formacion_Complementaria_Alumno.css">
<script src="../../Funciones/ocultardiv.js"></script>

<script>
function validarFechas() {
    var fechaInicio = new Date(document.getElementsByName("Fecha_Inicio")[0].value);
    var fechaFin = new Date(document.getElementsByName("Fecha_Fin")[0].value);

    if (fechaFin <= fechaInicio) {
        alert("La Fecha de Fin debe ser posterior a la Fecha de Inicio.");
        return false;
    }
    return true;
}
</script>

<?php

$dni = $_SESSION['dni'];
$sql = "SELECT * FROM Formacion_Complementaria WHERE DNI_CIF='$dni'";

if ($resultado = $conexion->query($sql)) {
   
        if ($resultado->rowCount() > 0) {
            ?>
<table>
    <tr>
        <th>Nombre</th>
        <th>Entidad emisora</th>
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>
        <th>Fecha Caducidad</th>
        <th>Horas</th>
        <th>Descripción</th>
        <th>Borrar</th>
        <th>Editar</th>
    </tr>
    <?php
    while ($row = $resultado->fetch(PDO::FETCH_OBJ)) {
    $Id_Formacion = $row->Id_Formacion_Complementaria;
    $Nombre_Formacion = $row->Nombre;
    $Entidad_emisora = $row->Entidad_Emisora;
    $Fecha_Inicio = $row->Fecha_Inicio;
    $Fecha_Fin = $row->Fecha_Fin;
    $Fecha_Caducidad = $row->Fecha_Caducidad;
    $Num_Horas = $row->Num_Horas;
    $Descripcion = $row->Descripcion;

    echo "
    <tr>
        <td>" . htmlspecialchars($Nombre_Formacion, ENT_QUOTES, 'UTF-8') . "</td>
        <td>" . htmlspecialchars($Entidad_emisora, ENT_QUOTES, 'UTF-8') . "</td>
        <td>" . $Fecha_Inicio . "</td>
        <td>" . $Fecha_Fin . "</td>
        <td>" . $Fecha_Caducidad . "</td>
        <td>" . $Num_Horas . "</td>
        <td>" . htmlspecialchars($Descripcion, ENT_QUOTES, 'UTF-8') . "</td>
        <td>
            <button class='papelera' onclick=\"showModal2('$Id_Formacion')\">🗑️</button>
        </td>
        <form id='formulario' action='Formacion_Complementaria/eliminarFormacion.php' method='POST'>
            <input type='hidden' name='id_Formacion' id='id_Formacion' value='$Id_Formacion'>
            <input type='hidden' id='confirmacionEliminacion' name='confirmacionEliminacion' value='false'>
            <div class='modal2' id='myModal2'>
                <div id='modal-content2' class='modal-content2'></div>
            </div>
            <script>
            function showModal2(id_Formacion) {
                var modal = document.getElementById('myModal2');
                modal.style.display = 'block';
                document.getElementById('modal-content2').innerHTML =
                    '<p>¿Estás seguro que quieres eliminarlo?</p>' +
                    '<button class=abrir onclick=\"confirmar(\'' + id_Formacion + '\')\">Confirmar</button>' +
                    '<button id=cerrar class=cerrar2 onclick=hideModal2()>Cancelar</button>'
            }

            function hideModal2() {
                var modal = document.getElementById('myModal2');
                modal.style.display = 'none';
            }

            function confirmar(id_Formacion) {
                document.getElementById('id_Formacion').value = id_Formacion;
                document.getElementById('confirmacionEliminacion').value = 'true';
                document.getElementById('formulario').submit();
            }
            </script>
        </form>
        <td>
            <button onclick=\"openModalFormacionEditar($Id_Formacion)\">✏️</button>
        </td>
    </tr>";
    }
    } else {
    echo "<p>Aún no has añadido formación complementaria.</p>";
    }
    ?>
</table>
<br>
<?php
}
?>
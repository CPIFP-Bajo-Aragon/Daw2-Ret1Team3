<?php
include "../../Funciones/conexion.php";
?>



<?php



$dni = $_SESSION['dni'];
$sql = "SELECT * FROM Experiencia_Laboral WHERE DNI_CIF='$dni'";


if ($resultado = $conexion->query($sql)) {
    while ($row = $resultado->fetch(PDO::FETCH_OBJ)) {
        $Id_Explab = $row->Id_Experiencia_Laboral;
        $Nombre_Complementaria = $row->Nombre_Empresa;
        $Descripcion = $row->Descripcion;
        $Fecha_Inicio = $row->Fecha_Inicio;
        $Fecha_Fin = $row->Fecha_Fin;
    }

}
?>








<?php
    $query = "SELECT * FROM Experiencia_Laboral WHERE DNI_CIF='$dni'";
    if ($result = $conexion->query($query)) {

        if ($resultado->rowCount() > 0) {
        ?>
<table>
    <tr>
        <th>Nombre Empresa</th>
        <th>Puesto</th>
        <th>Descripcion</th>
        <th>Fecha Inicio</th>
        <th>Fecha_Fin</th>
        <th>Borrar</th>
        <th>Editar</th>

    </tr>
    <?php
        } else{
            echo "<p>Aún no has agregado ninguna experiencia laboral.</p>";
        }
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $id_exp = $row->Id_Experiencia_Laboral;
            $Nombre = $row->Nombre_Empresa;
            $Puesto = $row->Puesto;
            $Descripcion = $row->Descripcion;
            $Fecha_Inicio = $row->Fecha_Inicio;
            $Fecha_Fin = $row->Fecha_Fin;

            echo " 
         <td> $Nombre</td>
         <td> $Puesto</td>
         <td> $Descripcion</td>
         <td> $Fecha_Inicio</td>
         <td> $Fecha_Fin</td>";
            ?>
    <td>
        <button class="papelera" onclick="showModal3('<?php echo $id_exp; ?>')">🗑️</button>
    </td>
    <form id='formulario3' action="Experiencia_Laboral/borrarexplab.php" method="POST">
        <input type="hidden" name="id_exp" id="id_exp" value="<?php echo $id_exp; ?>">
        <input type="hidden" id="confirmacionEliminacion3" name="confirmacionEliminacion3" value="false">

        <div class="modal3" id="myModal3">
            <div id="modal-content3" class="modal-content3"></div>
        </div>

        <script>
        function showModal3(id_exp) {
            var modal = document.getElementById('myModal3');
            modal.style.display = 'block';

            document.getElementById('modal-content3').innerHTML =
                "<p>¿Estás seguro que quieres eliminarlo?</p>" +
                "<button  class=abrir onclick=\"confirmar3('" + id_exp + "')\">Confirmar</button>" +
                "<button id=cerrar class=cerrar2 onclick=hideModal3()>Cancelar</button>"
        }

        function hideModal3() {
            var modal = document.getElementById('myModal3');
            modal.style.display = 'none';
        }

        function confirmar3(id_exp) {
            document.getElementById('id_exp').value = id_exp;
            document.getElementById('confirmacionEliminacion3').value = "true";
            document.getElementById('formulario3').submit();
        }
        </script>
    </form>

    <?php

            ?>
    <td>

        <button onclick="openModalExperienciaEditar(<?php echo $id_exp; ?>)">✏️</button>

    </td>
    </tr>

    <?php

        }

    }

    ?>


</table>
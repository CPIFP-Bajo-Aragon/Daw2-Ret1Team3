<?php include "../../Funciones/conexion.php";?>
<script>
desabilitar();
</script>
<?php
$dni = $_SESSION['dni'];

// Recoge los datos de Alumnos
$query = "SELECT Alumno.*, Municipio.Nombre_Municipio FROM Alumno, Municipio WHERE Alumno.Id_Municipio = Municipio.Id_Municipio AND DNI_CIF= '$dni'";


if ($result = $conexion->query($query)) {
    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
        $Apellido = $row->Apellido;
        $Fecha_Nacimiento = $row->Fecha_Nacimiento;
        $Telefono_Alumno = $row->Telefono_Alumno;
        $Foto_Alumno = property_exists($row, 'Foto_Alumno') ? $row->Foto_Alumno : null;
        $Movilidad = $row->Movilidad;
        $Direccion = $row->Direccion;
        $Perfil_Publico = $row->Perfil_Publico;
        $id_Municipio_usuario = $row->Id_Municipio;
        $Municipio = $row->Nombre_Municipio;
        $Coche = $row->Coche;
    }
}

$query = "SELECT * FROM Usuario WHERE DNI_CIF='$dni'";

if ($result = $conexion->query($query)) {
    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
        $Nombre_Usuario = $row->Nombre_Usuario;
    }
}
?>

<form method="POST" action="./Datos_principales/actualizar.php" enctype="multipart/form-data">
    <label for="Nombre">Nombre:</label>
    <input type="text" name="Nombre" value="<?php echo  $Nombre_Usuario; ?>" class="inicio-alumno">
    <label for="Apellido">Apellidos:</label>
    <input type="text" name="Apellido" value="<?php echo $Apellido; ?>" class="inicio-alumno">
    <label for="Fecha_Nacimiento">Fecha de Nacimiento:</label>
    <input type="date" name="Fecha_Nacimiento" class="inicio-alumno" required value="<?php echo $Fecha_Nacimiento; ?>">
    <label for="Telefono_Alumno">Teléfono del Alumno:</label>
    <input type="text" name="Telefono_Alumno" value="<?php echo $Telefono_Alumno; ?>" pattern="[0-9]+"
        class="inicio-alumno">
    <label for="Direccion">Dirección:</label>
    <input type="text" name="Direccion" value="<?php echo $Direccion; ?>" class="inicio-alumno">
    <label for="Municipio">Municipio:</label>

    <!------------------------------------------>

    <select name="municipios" id="municipios" class="inicio-alumno">
        <?php
        $query = "SELECT * FROM Municipio where Id_Municipio=$id_Municipio_usuario"; 
        if ($result = $conexion->query($query)) {
            while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                $Nombre_Municipio = $row->Nombre_Municipio;
                $id_Municipio = $row->Id_Municipio;
                echo "<option value='$id_Municipio'>$Nombre_Municipio</option>";
            }
        }

        $query = "SELECT * FROM Municipio ORDER BY Nombre_Municipio ASC"; 

        if ($result = $conexion->query($query)) {
            while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                $Nombre_Municipio = $row->Nombre_Municipio;
                $id_Municipio = $row->Id_Municipio;
                echo "<option value='$id_Municipio'>$Nombre_Municipio</option>";
            }
        }
        ?>
    </select>



    <div class="datosContaineralumno">
    <!------------------------------------------>
    <p class="itemContaineralumno">
    <label for="">Sube foto de perfil:</label>
    <input type="file" name="imagen" id="imagen" accept="image/png, image/gif, image/jpeg" class="inicio-alumno">
    </p>
    
    <p class="itemContaineralumno">
        <label for="Movilidad">Movilidad:</label>
        <input type="radio" name="Movilidad" id="radioMovilidad" value="0"
            <?php if ($Movilidad == 0) {echo "checked";} ?> class="inicio-alumno">
        <label for="radioNoMovilidad">NO</label>
        <input type="radio" name="Movilidad" id="radioMovilidad" value="1"
            <?php if ($Movilidad == 1) {echo "checked";} ?> class="inicio-alumno">
        <label for="radioSiMovilidad">SI</label>
    </p>

    <p class="itemContaineralumno">
        <label for="Movilidad">Dispone de coche:</label>
        <input type="radio" name="Coche" id="radioNoCoche" value="0" class="inicio-alumno">
        <label for="radioNo">NO</label>
        <input type="radio" name="Coche" id="radioSiCoche" value="1" class="inicio-alumno">
        <label for="radioSi">SI</label>
    </p>
    <p class="itemContaineralumno" id="perfil-publico">
    <label for="Perfil_Publico" class="datosPrincipalesmargin">Perfil Público:   </label>
    <input type="radio" name="Perfil_Publico" id="perfilNo" value="0" class="inicio-alumno">
    <label for="perfilNo">NO</label>
    <input type="radio" name="Perfil_Publico" id="perfilSi" value="1" class="inicio-alumno">
    <label for="perfilSi">SI</label>
    </p>    
    <script>
    var perfilPublico = <?php echo $Perfil_Publico; ?>;
    if (perfilPublico === 0) {
        document.getElementById('perfilNo').checked = true;
    } else if (perfilPublico === 1) {
        document.getElementById('perfilSi').checked = true;
    }
    </script>

    </div>
    <script>
    var Coche = <?php echo $Coche; ?>;
    if (Coche === 0) {
        document.getElementById('radioNoCoche').checked = true;
    } else {
        document.getElementById('radioSiCoche').checked = true;
    }
    </script>

    <input type="submit" value="Guardar Cambios" class="inicio-alumno">
</form>
<button onclick="editar();" id="botonEditar">Editar</button>


<script>
var campoinput = document.querySelectorAll('.inicio-alumno');
campoinput.forEach(function(element) {
    element.disabled = true;
});


function editar() {
    var campoinput = document.querySelectorAll('.inicio-alumno');
    campoinput.forEach(function(element) {
        element.disabled = false;
    });
}
</script>



<?php include "../../Funciones/SessionStart.php";?>
<?php include "../../Funciones/conexion.php";?>
<script>desabilitar();</script>
<?php

// Recoge los datos de Alumnos
$query = "SELECT Empresa.*, Municipio.Nombre_Municipio FROM Empresa, Municipio Municipio WHERE Empresa.Id_Municipio = Municipio.Id_Municipio AND DNI_CIF='$dni'";
if ($result = $conexion->query($query)) {
    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
        $Numero_Trabajadores = $row->Numero_Trabajadores;
        $Web = $row->Web;
        $Telefono = $row->Telefono;
        $Area_Negocio = $row->Area_Negocio;
        $Descripcion = $row->Descripcion;
        $Direccion = $row->Direccion;
        $Pais = $row->Pais;
        $Activo = $row->Activo;
        $DNI_CIF = $row->DNI_CIF;
        $Nombre_Municipio = $row->Nombre_Municipio;
    }
}

$query = "SELECT * FROM Usuario WHERE DNI_CIF='$dni'";

if ($result = $conexion->query($query)) {
    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
        $Nombre_Usuario = $row->Nombre_Usuario;
    }
}

?>
<form method="GET" action="./Datos_principales/actualizar.php" enctype="multipart/form-data">
    <label for="Empresa">Empresa:</label>
    <input type="text" name="Empresa" value="<?php echo  $username; ?>" class="inicio-alumno">
    <label for="DNI_CIF">CIF:</label>
    <input type="text" name="DNI_CIF" value="<?php echo $DNI_CIF; ?>" class="inicio-alumno">
    <label for="Web">Web:</label>
    <input type="text" name="Web" required value="<?php echo $Web; ?>" class="inicio-alumno">
    <label for="Numero_Trabajadores">Número de trabajadores:</label>
    <input type="text" name="Numero_Trabajadores" required value="<?php echo $Numero_Trabajadores; ?>" class="inicio-alumno">
   
    <label for="Direccion">Dirección:</label>
    <input type="text" name="Direccion" value="<?php echo $Direccion; ?>" class="inicio-alumno">
   
    <label for="Area_Negocio">Area_Negocio:</label>
    <input type="text" name="Area_Negocio" value="<?php echo $Area_Negocio; ?>" class="inicio-alumno">

    <label for="Telefono">Telefono:</label>
    <input type="text" name="Telefono" value="<?php echo $Telefono; ?>" class="inicio-alumno">

    <label for="Nombre_Municipio">Nombre_Municipio:</label>
    <input type="text" name="Nombre_Municipio" value="<?php echo $Nombre_Municipio; ?>" class="inicio-alumno">

    <label for="Pais">Pais:</label>
    <input type="text" name="Pais" value="<?php echo $Pais; ?>" class="inicio-alumno">

    <label for="Descripcion">Descripcion:</label>
    <br>
    <textarea rows="4" cols="50" name="Descripcion" value="<?php echo $Descripcion; ?>" form="usrform" class="inicio-alumno"></textarea>
    <br>



    
    <label for="">Sube foto de perfil:</label>
    <input type="file" name="imagen" id="imagen" accept=".png" class="inicio-alumno">
    
    <input type="submit" value="Guardar Cambios" class="inicio-alumno" >

    </form>

        <button onclick="editar();" id="botonEditar">Editar</button>


    <script>
        var campoinput = document.querySelectorAll('.inicio-alumno');
        campoinput.forEach(function(element) {
            element.disabled = true;
        });
            

        function editar(){
            var campoinput = document.querySelectorAll('.inicio-alumno');
        campoinput.forEach(function(element) {
            element.disabled = false;
        });
        }
    </script>
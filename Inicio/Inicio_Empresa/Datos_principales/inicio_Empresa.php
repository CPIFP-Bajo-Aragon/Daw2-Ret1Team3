


<?php include "../../Funciones/SessionStart.php";?>
<?php include "../../Funciones/conexion.php";?>
<script>desabilitar();</script>
<?php

$dni = $_SESSION['dni'];

   $Numero_Trabajadores = "";
   $Web = "";
   $Telefono = "";
   $Area_Negocio = "";
   $Descripcion = "";
   $Direccion = "";
   $Pais = "";
   $Activo = "";
   $DNI_CIF = "";
   $Nombre_Municipio = "";
   $id_Municipio_Empresa = 8123;

$query = "SELECT Empresa.*, Municipio.Nombre_Municipio FROM Empresa, Municipio WHERE Empresa.Id_Municipio = Municipio.Id_Municipio AND Empresa.DNI_CIF='$dni'";

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
        $id_Municipio_Empresa = $row->Id_Municipio;
    }
}

$query = "SELECT * FROM Usuario WHERE DNI_CIF='$dni'";

if ($result = $conexion->query($query)) {
    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
        $Nombre_Usuario = $row->Nombre_Usuario;
    }
}

$_SESSION['username'] = $Nombre_Usuario;

?>
<form method="POST" action="./Datos_principales/actualizar.php" enctype="multipart/form-data">
    <label for="Empresa">Empresa:</label>
    <input type="text" name="Empresa" value="<?php echo  $username; ?>" class="inicio-alumno">
    <label for="Web">Web:</label>
    <input type="text" name="Web" value="<?php echo $Web; ?>" class="inicio-alumno">
    <label for="Numero_Trabajadores">Número de trabajadores:</label>
    <input type="text" name="Numero_Trabajadores" required value="<?php echo $Numero_Trabajadores; ?>" class="inicio-alumno">
   
    <label for="Direccion">Dirección:</label>
    <input type="text" name="Direccion" value="<?php echo $Direccion; ?>" class="inicio-alumno">
   
    <label for="Area_Negocio">Area_Negocio:</label>
    <input type="text" name="Area_Negocio" value="<?php echo $Area_Negocio; ?>" class="inicio-alumno">

    <label for="Telefono">Telefono:</label>
    <input type="text" name="Telefono" value="<?php echo $Telefono; ?>" pattern="[0-9]+" class="inicio-alumno">

    <label for="municipios">Municipio:</label>

    <select name="Nombre_Municipio" id="Nombre_Municipio" class="inicio-alumno">
        <?php
        $query = "SELECT * FROM Municipio where Id_Municipio=$id_Municipio_Empresa"; 
        if ($result = $conexion->query($query)) {
            while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                $Nombre_Municipio = $row->Nombre_Municipio;
                $id_Municipio = $row->Id_Municipio;
                echo "<option value='$id_Municipio'>$Nombre_Municipio</option>";
            }
        }

    ?>
</select>

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
<?php
include "../../Funciones/conexion.php";
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
if(isset($_GET['resultado'])){
if($_GET['resultado']=="true"){
    ?>
    <script>
    Swal.fire({
        position: "center",
        icon: "success",
        title: "Se a realizado los cambios",
        showConfirmButton: false,
        timer: 1500
      });
      </script>
    <?php
}
if($_GET['resultado']=="false"){
    ?>
    <script>
    Swal.fire({
        position: "center",
        icon: "error",
        title: "No se han realizado los cambios",
        showConfirmButton: false,
        timer: 1500
      });
      </script>
    <?php
}
}

?>
<form action="index.php" method="post">
<select name="alumno" id="">
<?php 
$sql="SELECT * FROM Usuario, Alumno WHERE Tipo_Usuario='Alumno' AND Usuario.DNI_CIF=Alumno.DNI_CIF";
if($resultado = $conexion -> query($sql)){
    ?>
        <option value="">- Alumno -</option>
        <?php
    while($row = $resultado->fetch(PDO::FETCH_OBJ)){
        $nombreuser= $row-> Nombre_Usuario;
        $apellidouser=$row -> Apellido;
        $dniuser=$row-> DNI_CIF;
        ?>
        <option value="<?php echo $dniuser?>"><?php echo $nombreuser." ".$apellidouser." - ".$dniuser?></option>
        <?php 
    }
    ?>
    </select>
    <?php 
}
?>
<input type="submit" name="editarUser" value="Editar">
</form>
<?php
if(isset($_POST['editarUser'])){
    $dnicifUser=$_POST['alumno'];
    if($dnicifUser==""){
    }else{
    $sqlw="SELECT * FROM Usuario, Alumno WHERE Tipo_Usuario='Alumno' AND Usuario.DNI_CIF=Alumno.DNI_CIF AND Alumno.DNI_CIF='$dnicifUser'";
    //echo $sqlw;
    if($resultado = $conexion -> query($sqlw)){
        while($row = $resultado->fetch(PDO::FETCH_OBJ)){
            $nombre=$row -> Nombre_Usuario;
            $apellido=$row -> Apellido;
            $fnac=$row -> Fecha_Nacimiento;
            $telf=$row -> Telefono_Alumno;
            $direccion=$row -> Direccion;
            $ppublico=$row -> Perfil_Publico;
            $movilidad=$row -> Movilidad;
            $coche=$row -> Coche;
            $idmunicipio=$row -> Id_Municipio;
        }

    }


    ?>
    <form action="cambiar_usuario.php" method="post">
        <label for="">Nombre:</label>
        <input type="text" name="nombreUser" id="" value="<?php echo $nombre ?>">
        <label for="">Apellidos:</label>
        <input type="text" name="apellidoUser" id="" value="<?php echo $apellido ?>">
        <label for="">Telefono movil:</label>
        <input type="text" name="telUser" id="" value="<?php echo $telf ?>">
        <label for="">Direccion:</label>
        <input type="text" name="direccUser" id="" value="<?php echo $direccion ?>">
        <label for="">DNI:</label>
        <input type="text" name="dniUser" id="" value="<?php echo $dnicifUser ?>">
        <label for="">Fecha nacimiento:</label>
        <input type="date" name="fnacUser" id="" value="<?php echo $fnac ?>">
        <label for="">Municipio:</label>
        <select name="municipios" id="municipios" class="js-example-basic-single"  name="states[]">
            <?php
            $query = "SELECT * FROM Municipio where Id_Municipio=$idmunicipio"; 
            if ($result = $conexion->query($query)) {
                while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                    $Nombre_Municipio = $row->Nombre_Municipio;
                    $id_Municipio = $row->Id_Municipio;
                    echo "<option value='$idmunicipio'>$Nombre_Municipio</option>";
                }
            }

            $query = "SELECT * FROM Municipio ORDER BY Nombre_Municipio ASC"; 

            if ($result = $conexion->query($query)) {
                while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                    $Nombre_Municipio = $row->Nombre_Municipio;
                    $id_Municipio = $row->Id_Municipio;
                    echo "<option value='$idmunicipio'>$Nombre_Municipio</option>";
                }
            }
            ?>
        </select>
        <div class="buttonEditarUser">
        
        <label for="">Perfil publico:</label>
        <p>
        <label for="">Si</label>
        <input type="radio" name="ppublicoUser" value="1" id="perfilSi">
        </p>
        <p>
        <label for="">No</label>
        <input type="radio" name="ppublicoUser" value="0"id="perfilNo">
        </p>
        <script>
        var perfilPublico = <?php echo $ppublico; ?>;
        if (perfilPublico === 0) {
            document.getElementById('perfilNo').checked = true;
        } else if (perfilPublico === 1) {
            document.getElementById('perfilSi').checked = true;
        }
        </script>

        <label for="">Movilidad:</label>
        <p>
        <label for="">Si</label>
        <input type="radio" name="movilidadUser" value="1" id="movilidadSi">
        </p>
        <p>
        <label for="">No</label>
        <input type="radio" name="movilidadUser" value="0"id="movilidadNo">
        </p>
        <script>
        var perfilPublico = <?php echo $movilidad; ?>;
        if (perfilPublico === 0) {
            document.getElementById('movilidadNo').checked = true;
        } else if (perfilPublico === 1) {
            document.getElementById('movilidadSi').checked = true;
        }
        </script>

        <label for="">Coche:</label>
        <p>
        <label for="">Si</label>
        <input type="radio" name="cocheUser" value="1" id="cocheSi">
        </p>
        <p>
        <label for="">No</label>
        <input type="radio" name="cocheUser" value="0"id="cocheNo">
        </p>
        <script>
        var perfilPublico = <?php echo $coche; ?>;
        if (perfilPublico === 0) {
            document.getElementById('cocheNo').checked = true;
        } else if (perfilPublico === 1) {
            document.getElementById('cocheSi').checked = true;
        }
        </script>
        </div>
        <input type="submit" name="guardarCambios" value="Guardar cambios">
    </form>
<?php
}
}
?>

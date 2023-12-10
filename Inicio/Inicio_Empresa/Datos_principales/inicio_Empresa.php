

    <!-- Incluir jQuery desde CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <!-- Mi script -->
    <script src="../../Funciones/select2.js"></script>
<?php $dni = $_SESSION['dni'];?>
<?php
$web="";
$telefono = "";
$descripcion = "";
$Direccion = "";
$id_Municipio_usuario = "";
$sql = "SELECT * FROM Empresa WHERE DNI_CIF='$dni'";
//echo $sql;
if ($resultado = $conexion->query($sql)) {
    while ($row = $resultado->fetch(PDO::FETCH_OBJ)) {
        $numtrabajadores = $row->Numero_Trabajadores;
        $web = $row->Web;
        $telefono = $row->Telefono;
        $descripcion = $row->Descripcion;
        $Direccion = $row->Direccion;
        $id_Municipio_usuario = $row->Id_Municipio;
        $id_pais= $row-> Pais;
        $area= $row->Area_Negocio;
    }
}
$sql = "SELECT * FROM Usuario WHERE DNI_CIF='$dni'";
if ($res = $conexion->query($sql)) {
    while ($row = $res->fetch(PDO::FETCH_OBJ)) {
        $nombre = $row->Nombre_Usuario;
    }
}
$sql = "SELECT * FROM Empresa, paises WHERE DNI_CIF='$dni' AND Empresa.Pais = paises.id";
if ($res = $conexion->query($sql)) {
    while ($row = $res->fetch(PDO::FETCH_OBJ)) {
        $Pais = $row->nombre;
    }
}
?>

<form action="./Datos_principales/actualizar.php" method="post" enctype="multipart/form-data">
    <label for="">Nombre</label><span class="campo-obligatorio">*</span>
    <input type="text" name="nombre" id="" value="<?php echo $nombre ?>" class="inicio-empresa" required>

    <label for="">Número de trabajadores</label>
    <br>
    <br>
    <input type="number" name="ntrabajadores" id="" value="<?php echo $numtrabajadores ?>" class="inicio-empresa"
        min="1">
    <br>
    <br>
    <label for="">Web</label>
    <input type="text" name="web" id="" value="<?php echo $web ?>" class="inicio-empresa">
    <label for="">Telefono</label>
    <input type="text" name="telefono" id="" pattern="[0-9]+" value="<?php echo $telefono ?>" class="inicio-empresa">
    <label for="">Direccion</label>
    <input type="text" name="direccion" id="" value="<?php echo $Direccion ?>" class="inicio-empresa">
    <label for="">Descripcion</label>
    <br>
    <textarea name="descripcion" id="" cols="30" rows="10" class="inicio-empresa"><?php echo $descripcion ?></textarea>
    <br>
    <br>
    <label for="">Pais</label> <span class="campo-obligatorio">*</span>

    <!-- que escoja un pais -->
    <select name="pais" id="" class="inicio-empresa">
        <?php
        $query = "SELECT * FROM paises where id=$id_pais"; 
        if ($result = $conexion->query($query)) {
            while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                $Nombre_Pais = $row->nombre;
                $id_p = $row->id;
                echo "<option value='$id_p'>$Nombre_Pais</option>";
            }
        }
        $query = "SELECT * FROM paises ORDER BY nombre ASC";
        //echo $query; 

        if ($result = $conexion->query($query)) {
            while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                $Nombre_Pais = $row->nombre;
                $id_p = $row->id;
                echo "<option value='$id_p'>$Nombre_Pais</option>";
            }
        }        

?>
    </select>
    <label for="">Municipio</label> <span class="campo-obligatorio">*</span>

    <!-- que escoja un municipio -->
    <select name="municipios" id="municipios" class="inicio-empresa">
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
        //echo $query; 

        if ($result = $conexion->query($query)) {
            while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                $Nombre_Municipio = $row->Nombre_Municipio;
                $id_Municipio = $row->Id_Municipio;
                echo "<option value='$id_Municipio'>$Nombre_Municipio</option>";
            }
        }
        ?>
    </select>
    <label for="">Area de negocio:</label> <span class="campo-obligatorio">*</span>

    <select name="area" id="area" class="inicio-empresa">
        <?php
        $query = "SELECT * FROM AreasDeNegocio WHERE ID = $area"; 
        if ($result = $conexion->query($query)) {
            while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                $AreaNegocio = $row->Nombre;
                $IdArea = $row->ID;
                echo "<option value='$IdArea'>$AreaNegocio</option>";
            }
        }
        
        $query = "SELECT * FROM AreasDeNegocio"; 
        if ($result = $conexion->query($query)) {
            while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                $AreaNegocio = $row->Nombre;
                $IdArea = $row->ID;
                echo "<option value='$IdArea'>$AreaNegocio</option>";
            }
        }
        ?>
    </select>
    <label for="">Sube foto de perfil:</label>
    <input type="file" name="imagen" id="imagen" accept="image/png, image/gif, image/jpeg" class="inicio-empresa">
    <br>
    <input type="submit" name="guardarcambios" value="Guardar cambios" class="inicio-empresa">

</form>
<button onclick="editar();" id="botonEditar">Editar</button>


<script>
var campoinput = document.querySelectorAll('.inicio-empresa');
campoinput.forEach(function(element) {
    element.disabled = true;
});

function editar() {
    var campoinput = document.querySelectorAll('.inicio-empresa');
    campoinput.forEach(function(element) {
        element.disabled = false;
    });
}
</script>
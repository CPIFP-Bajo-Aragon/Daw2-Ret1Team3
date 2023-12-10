
<?php $dni = $_SESSION['dni'];?>

<?php
$apellidoAdmin="";
$sql = "SELECT * FROM Admin WHERE DNI_CIF='$dni'";
//echo $sql;
if ($resultado = $conexion->query($sql)) {
    while ($row = $resultado->fetch(PDO::FETCH_OBJ)) {
        $apellidoAdmin = $row->Apellido;
    }
}
$sql = "SELECT * FROM Usuario WHERE DNI_CIF='$dni'";
if ($res = $conexion->query($sql)) {
    while ($row = $res->fetch(PDO::FETCH_OBJ)) {
        $nombreAdmin = $row->Nombre_Usuario;
    }
}
?>

<form action="./Datos_principales/actualizar.php" method="post" enctype="multipart/form-data">
    <label for="">Nombre: </label>
    <input type="text" name="nombreAdmin" id="" value="<?php echo $nombreAdmin ?>" class="inicio-admin">
    <label for="">Apellidos: </label>
    <input type="text" name="apellidoAdmin" id="" value="<?php echo $apellidoAdmin ?>" class="inicio-admin">
    
    <label for="">Subir Fotos: </label>
    <input type="file" name="imagen" id="imagen" accept="image/png, image/gif, image/jpeg" class="inicio-admin">
    <br>    
    <br>    
    <input type="submit" name="guardarcambios" value="Guardar cambios" class="inicio-admin">


</form>
<button onclick="editar();" id="botonEditar">Editar</button>


<script>
var campoinput = document.querySelectorAll('.inicio-admin');
campoinput.forEach(function(element) {
    element.disabled = true;
});

function editar() {
    var campoinput = document.querySelectorAll('.inicio-admin');
    campoinput.forEach(function(element) {
        element.disabled = false;
    });
}
</script>
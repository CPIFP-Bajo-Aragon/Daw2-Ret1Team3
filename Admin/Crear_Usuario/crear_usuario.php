<?php
include "../../Funciones/conexion.php";
?>
<h1>Crear Usuario</h1>
<form action="" method="post">
    <label for="">Nombre:</label>
    <input type="text" name="nombreadmin" id="">
    <br>
    <label for="">Apellidos:</label>
    <input type="text" name="apellidosadmin" id="">
    <br>
    <label for="">Email:</label>
    <input type="email" name="emailadmin" id="">
    <br>
    <label for="">DNI:</label>
    <input type="text" name="dniadmin" id="">
    <br>
    <label for="">Contraseña:</label>
    <input type="password" name="contrasenadmin" id="">
    <br>
    <input type="submit" name="crearalumno" value="Crear Alumno">
</form>
<p id="resultado"></p>
<?php
if (isset($_POST['crearalumno'])){
include "../../Funciones/conexion.php";

$nombreadmin=$_POST['nombreadmin'];
$apellidosadmin=$_POST['apellidosadmin'];
$emailadmin=$_POST['emailadmin'];
$dniadmin=$_POST['dniadmin'];
$contrasenadmin=$_POST['contrasenadmin'];


$contcifrado = hash('sha256', $contrasenadmin);

$sentencia = $conexion->prepare("INSERT INTO Usuario (DNI_CIF, Email, Clave, Nombre_Usuario, Tipo_Usuario) VALUES (?, ?, ?, ?, 'Alumno')");
$sentencia->bindParam(1, $dniadmin);
$sentencia->bindParam(2, $emailadmin);
$sentencia->bindParam(3, $contcifrado);
$sentencia->bindParam(4, $nombreadmin);

$sentencia2 = $conexion->prepare("INSERT INTO Alumno (Apellido, DNI_CIF,Activo) VALUES (?,?,1)");
$sentencia2->bindParam(1, $apellidosadmin);
$sentencia2->bindParam(2, $dniadmin);

try {
    if(!empty($dniadmin)||!empty($emailadmin)||!empty($nombreadmin)|| !empty($apellidosadmin) || !empty($contcifrado)){
    $sentencia->execute();
    $sentencia2->execute();
    ?>
    <script>
            document.getElementById("resultado").innerHTML = "Usuario creado correctamente";

    </script>
    <?php
    }else{
        ?>
        <script>
                document.getElementById("resultado").innerHTML = "Usuario no ha podido ser creado";
        </script>
        <?php
    }
}catch(PDOException $e){
    ?>
    <script>
            document.getElementById("resultado").innerHTML = "Usuario no ha podido ser creado";
    </script>
    <?php
}   
}
?>
<?php
include "../../Funciones/conexion.php";
?>
<h1>Crear Empresa</h1>
<form action="" method="post">
    <label for="">Nombre:</label>
    <input type="text" name="nombreadmin" id="">
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
    <input type="submit" name="crearadmin" value="Crear Empresa">
</form>
<p id="resultado"></p>
<?php
if (isset($_POST['crearadmin'])){
include "../../Funciones/conexion.php";

$nombreadmin=$_POST['nombreadmin'];
$emailadmin=$_POST['emailadmin'];
$dniadmin=$_POST['dniadmin'];
$contrasenadmin=$_POST['contrasenadmin'];


$contcifrado = hash('sha256', $contrasenadmin);

$sentencia = $conexion->prepare("INSERT INTO Usuario (DNI_CIF, Email, Clave, Nombre_Usuario, Tipo_Usuario) VALUES (?, ?, ?, ?, 'Empresa')");
$sentencia->bindParam(1, $dniadmin);
$sentencia->bindParam(2, $emailadmin);
$sentencia->bindParam(3, $contcifrado);
$sentencia->bindParam(4, $nombreadmin);

$sentencia2 = $conexion->prepare("INSERT INTO Empresa (DNI_CIF,Activo) VALUES (?,1)");
$sentencia2->bindParam(1, $dniadmin);

try {
    if (!empty($nombreadmin) || !empty($emailadmin) || !empty($dniadmin) || !empty($contcifrado)) {
    $sentencia->execute();
    $sentencia2->execute();
    ?>
    <script>
            document.getElementById("resultado").innerHTML = "Empresa creada correctamente";

    </script>
    <?php
    }else{
        ?>
        <script>
                document.getElementById("resultado").innerHTML = "La empresa no ha podido ser creada";
    
        </script>
        <?php
    }
}catch(PDOException $e){
    ?>
    <script>
            document.getElementById("resultado").innerHTML = "La empresa no ha podido ser creada";

    </script>
    <?php
}   
}
?>
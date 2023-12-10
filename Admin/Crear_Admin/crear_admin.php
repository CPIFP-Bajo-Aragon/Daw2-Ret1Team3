<?php
include "../../Funciones/conexion.php";
?>
<h1>Crear administrador</h1>
<form action="" method="POST">
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
    <input type="submit" name="crearadmin" value="Crear admin">
</form>
<p id="resultado"></p>
<?php
if (isset($_POST['crearadmin'])){
include "../../Funciones/conexion.php";
$dniorigen=$_SESSION['dni'];

$nombreadmin=$_POST['nombreadmin'];
$apellidosadmin=$_POST['apellidosadmin'];
$emailadmin=$_POST['emailadmin'];
$dniadmin=$_POST['dniadmin'];
$contrasenadmin=$_POST['contrasenadmin'];


$contcifrado = hash('sha256', $contrasenadmin);

$sentencia = $conexion->prepare("INSERT INTO Usuario (DNI_CIF, Email, Clave, Nombre_Usuario, Tipo_Usuario) VALUES (?, ?, ?, ?, 'Admin')");
$sentencia->bindParam(1, $dniadmin);
$sentencia->bindParam(2, $emailadmin);
$sentencia->bindParam(3, $contcifrado);
$sentencia->bindParam(4, $nombreadmin);


$sentencia2 = $conexion->prepare("INSERT INTO Admin (Apellido, DNI_CIF) VALUES (?,?)");
$sentencia2->bindParam(1, $apellidosadmin);
$sentencia2->bindParam(2, $dniadmin);

try {
    if (!empty($nombreadmin) || !empty($apellidosadmin) || !empty($emailadmin) || !empty($dniadmin) || !empty($contrasenadmin)) {
    $sentencia->execute();
    $sentencia2->execute();
    $vista = 1;
    $nuevaAlerta="Has creado una cuenta Admin con el siguiente Nombre: ". $nombreadmin;

    $sentenciaInsert = $conexion->prepare("INSERT INTO Alertas (Alerta, DNI_CIF, Vista) VALUES (?, ?, ?)");
    $sentenciaInsert->bindParam(1, $nuevaAlerta);
    $sentenciaInsert->bindParam(2, $dniorigen);
    $sentenciaInsert->bindParam(3, $vista);
    $sentenciaInsert->execute();


                $nuevaAlerta = "¡Bienvenido a tu cuenta como Administrador! Aquí encontrarás varios apartados delicados. Por favor, ten precaución con las acciones que realices. Si has llegado aquí por error, te agradeceríamos que lo  <a href='../../Reportes/index.php' target='_blank'>comuniques a otro administrador.</a>";

    $sentenciaInsert = $conexion->prepare("INSERT INTO Alertas (Alerta, DNI_CIF, Vista) VALUES (?, ?, ?)");
    $sentenciaInsert->bindParam(1, $nuevaAlerta);
    $sentenciaInsert->bindParam(2, $dniadmin);
    $sentenciaInsert->bindParam(3, $vista);
    $sentenciaInsert->execute();
    ?>
    <script>
            document.getElementById("resultado").innerHTML = "Administrador creado correctamente";

    </script>
    <?php
    }
 else {
    ?>
    <script>
            document.getElementById("resultado").innerHTML = "Administrado no se ha creado correctamente porque faltan campos ";

    </script>
    <?php
}
}catch(PDOException $e){
    ?>
    <script>
            document.getElementById("resultado").innerHTML = "Administrado no se ha creado correctamente";

    </script>
    <?php
}   
}
?>
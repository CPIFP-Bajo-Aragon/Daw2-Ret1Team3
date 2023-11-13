<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Usuario</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="contenido">
        <h1>👤Registrar Usuario👤</h1>

        <form action="registroUsuarios.php" method="POST" id="primero">
            <input type="text" name="Nombre" id="Nombre" placeholder="Nombre" required> <br>
            <input type="text" name="Apellido" id="Apellido" placeholder="Apellido" required> <br>
            <input type="Email" name="Email" id="Email" placeholder="Email" required
                pattern="[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-]([\.]?[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-])+@[a-zA-Z0-9]([^@&%$\/\(\)=?¿!\.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?">
            <br>
            <input type="text" name="DNI" id="DNI" placeholder="DNI" required minlength='7'> <br>
            <input type="password" name="clave" id="clave" placeholder="Contraseña" required> <br>
            <input type="password" name="repetir_clave" id="repetir_clave" placeholder="Repetir contraseña" required>
            <br>
            <input type="submit" value="Registrarse">
        </form>
        <p id='resultado' style=' text-align: center;
   color: red;'></p>
    </div>
</body>

</html>
<?php include "../../Funciones/conexion.php";?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["Nombre"];
    $apellido = $_POST["Apellido"];
    $email = $_POST["Email"];
    $dni = $_POST["DNI"];
    $clave = $_POST["clave"];
    $repetir_clave = $_POST["repetir_clave"];

    session_start();
    $_SESSION['dni'] = $dni;
    
    if (empty($nombre) || empty($apellido) || empty($email) || empty($dni) || empty($clave) || empty($repetir_clave)) {

        echo (" 
        <style>
        #primero{
            display:none;
        }
        </style>
        <form action='registroUsuarios.php' method='POST'> 
        <input type='text' name='Nombre' id='Nombre' placeholder='Nombre' required value=$nombre> <br> 
        <input type='text' name='Apellido' id='Apellido' placeholder='Apellido' required value=$apellido> <br> 
        <input  value=$email type='Email' name='Email' id='Email' placeholder='Email' required pattern=\"[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-]([\.]?[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-])+@[a-zA-Z0-9]([^@&%$\/\(\)=?¿!\.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?\"> <br> 
        <input value=$dni type='text' name='DNI' id='DNI' placeholder='DNI' required minlength='7'> <br> 
        <input value=$clave type='password' name='clave' id='clave' placeholder='Contraseña' required> <br> 
        <input value=$repetir_clave type='password' name='repetir_clave' id='repetir_clave' placeholder='Repetir contraseña' required>  <br> 
        <input type='submit' value='Registrarse'>
        </form>
       
 
        ");
        ?>
        <script type="text/javascript">
            document.getElementById("resultado").innerHTML = "Por favor, completa todos los campos.";
        </script>
        <?php
    } else if ($clave !== $repetir_clave) {

        echo (" 
        <style>
        #primero{
            display:none;
        }
        </style>
        <form action='registroUsuarios.php' method='POST'> 
        <input type='text' name='Nombre' id='Nombre' placeholder='Nombre' required value=$nombre> <br> 
        <input type='text' name='Apellido' id='Apellido' placeholder='Apellido' required value=$apellido> <br> 
        <input  value=$email type='Email' name='Email' id='Email' placeholder='Email' required pattern=\"[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-]([\.]?[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-])+@[a-zA-Z0-9]([^@&%$\/\(\)=?¿!\.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?\"> <br> 
        <input  value=$dni type='text' name='DNI' id='DNI' placeholder='DNI' required minlength='7'> <br> 
        <input type='password' name='clave' id='clave' placeholder='Contraseña' required> <br> 
        <input  type='password' name='repetir_clave' id='repetir_clave' placeholder='Repetir contraseña' required>  <br> 
        <input type='submit' value='Registrarse'>
        </form>

        ");
        ?>
            <script type="text/javascript">
                document.getElementById("resultado").innerHTML = "Las contraseñas no coinciden";
            </script>
    <?php
    } else {

        $pass = $_POST["clave"];
        $passCifrada = hash('sha256', $pass);

        $sentencia = $conexion->prepare("INSERT INTO bolsa_emplea.Usuario (DNI_CIF, Email, Clave, Nombre_Usuario, Tipo_Usuario) VALUES (?, ?, ?, ?, 'Alumno')");
        $sentencia->bindParam(1, $dni);
        $sentencia->bindParam(2, $email);
        $sentencia->bindParam(3, $passCifrada);
        $sentencia->bindParam(4, $nombre);


        $sentencia2 = $conexion->prepare("INSERT INTO bolsa_emplea.Alumno (Apellido, DNI_CIF) VALUES (?,?)");
        $sentencia2->bindParam(1, $apellido);
        $sentencia2->bindParam(2, $dni);

        try {
            $sentencia->execute();
            $sentencia2->execute();
            ?>
                <script>
                    document.getElementById("resultado").innerHTML = "El usuario se ha registrado correctamente";
                    document.getElementById("resultado").style.color = "green";
                </script>
            <?php
        } catch (PDOException $e) {

            echo (" 
            <style>
            #primero{
                display:none;
            }
            </style>
            <form action='registroUsuarios.php' method='POST'> 
            
            <input type='text' name='Nombre' id='Nombre' placeholder='Nombre' required value=$nombre> <br> 
            <input type='text' name='Apellido' id='Apellido' placeholder='Apellido' required value=$apellido> <br> 
            <input  type='Email' name='Email' id='Email' placeholder='Email' required pattern=\"[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-]([\.]?[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-])+@[a-zA-Z0-9]([^@&%$\/\(\)=?¿!\.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?\"> <br> 
            <input  type='text' name='DNI' id='DNI' placeholder='DNI' required minlength='7'>  <br> 
            <input value=$clave  type='password' name='clave' id='clave' placeholder='Contraseña' required> <br> 
            <input  value=$repetir_clave  type='password' name='repetir_clave' id='repetir_clave' placeholder='Repetir contraseña' required>  <br> 
            <input type='submit' value='Registrarse'>
            </form>
          

            ");
            ?>
                <script>
                    document.getElementById("resultado").innerHTML = "Error al Registrarse, alguno de tus datos ya estan registrados";
                </script>
            <?php
        }



    }
}


?>
<a href="../"><button>Volver Atras</button></a>
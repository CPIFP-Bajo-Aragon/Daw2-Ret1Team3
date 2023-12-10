<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>

    <!-- Link de estilos globales -->
    <link rel='stylesheet' href='../../style.css' type='text/css' />

    <link rel='stylesheet' href='style.css' type='text/css' />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body>
    <div class='FlexContainer'>
        <header>
            <div id="divuno">
                <div>
                    <img src="../../img/logo_cpifp.png" alt="imagen del cpifp bajo aragon">
                    <img src="../../img/logo_gob_eu.png" alt="Imagen gobierno de aragon">
                </div>
                <div id="button">
                    <a href="../../Login/login.php"><button id="boton_login">
                            Iniciar Sesion
                        </button></a>
                    <a href="../../Registro/index.html"><button id="boton_registro">
                            Registrarse
                        </button></a>
                </div>
            </div>
        </header>

        <div id="registro_empresa">

            <div id="texto">
                <h1>Registrate como empresa.</h1>
            </div>


            <div id="registro-empresa-parte">
                <form action="registroUsuarios.php" class="formulario" id="formulario" method="POST">

                    <!-- Usuario -->
                    <div class="formulario__grupo" id="grupo__nombre">
                        <label for="Nombre" class="formulario__label">Nombre</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="Nombre" id="nombre" placeholder="">
                            <i class="formulario__validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario__input-error">Introduce un Nombre correcto.</p>
                    </div>

                    <!-- Apellido -->
                    <div class="formulario__grupo" id="grupo__apellidos">
                        <label for="Apellido" class="formulario__label">Apellidos</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="Apellido" id="apellidos" placeholder="">
                            <i class="formulario__validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario__input-error">Introduce un Apellido correcto.</p>
                    </div>

                    <!--Correo Electronico -->
                    <div class="formulario__grupo" id="grupo__correo">
                        <label for="Email" class="formulario__label">Correo Electrónico</label>
                        <div class="formulario__grupo-input">
                            <input type="email" class="formulario__input" name="Email" id="correo"
                                placeholder="correo@correo.com">
                            <i class="formulario__validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario__input-error">Introduce un correo valido.</p>
                    </div>
                    <!-- dni-->
                    <div class="formulario__grupo" id="grupo__dni">
                        <label for="DNI" class="formulario__label">Dni</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="DNI" id="dni" placeholder="">
                            <i class="formulario__validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario__input-error">Introduce un dni correcto.</p>
                    </div>

                    <!-- Contraseña -->
                    <div class="formulario__grupo" id="grupo__password">
                        <label for="clave" class="formulario__label">Contraseña</label>
                        <div class="formulario__grupo-input">
                            <input type="password" class="formulario__input" name="clave" id="password">
                            <i class="formulario__validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario__input-error">La contraseña tiene que ser de 4 a 12 dígitos.</p>
                    </div>

                    <!-- Grupo: Contraseña 2 -->
                    <div class="formulario__grupo" id="grupo__password2">
                        <label for="repetir_clave" class="formulario__label">Repetir Contraseña</label>
                        <div class="formulario__grupo-input">
                            <input type="password" class="formulario__input" name="repetir_clave" id="password2">
                            <i class="formulario__validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>
                    </div>


                    <!-- Grupo: Terminos y Condiciones -->
                    <div class="formulario__grupo" id="grupo__terminos">
                        <label class="formulario__label">
                            <input class="formulario__checkbox" type="checkbox" name="terminos" id="terminos">
                            Acepto los Terminos y Condiciones
                        </label>
                    </div>

                    <div class="formulario__mensaje" id="formulario__mensaje">
                        <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario
                            correctamente. </p>
                    </div>

                    <div class="formulario__grupo formulario__grupo-btn-enviar">
                        <button type="submit" class="formulario__btn">Enviar</button>
                        <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado
                            exitosamente!</p>
                    </div>
                </form>
                <script src="../../Funciones/formulario.js"></script>
                <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
            </div>

        </div>
    </div>

    <p id='resultado' style='text-align: center; color: red;'></p>



    <footer>
        <div id="divcinco">
            <div>
                <i class="fa fa-facebook"></i>
                <i class="fa fa-twitter"></i>
                <i class="fa fa-instagram"></i>
                <i class="fa fa-github"></i>

            </div>
            <div id="otroContenido">
                <p>#PlanDeRecuperacion</p>
                <p>#NextGenerationEU</p>
            </div>
            <div id="copiright">
                Profitech Alcañiz © 2002 - 2023 Reservados
            </div>
        </div>
    </footer>
    </div>

</body>

</html>


<?php
include "../../Funciones/conexion-inicio.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST["Nombre"];
    $apellido = $_POST["Apellido"];
    $email = $_POST["Email"];
    $dni = $_POST["DNI"];
    $clave = $_POST["clave"];
    $repetir_clave = $_POST["repetir_clave"];
   

    // session_start();
    // $_SESSION['dni'] = $dni;
    
    if (empty($nombre) || empty($apellido) || empty($email) || empty($dni) || empty($clave) || empty($repetir_clave)) {

        echo (" 
        <style>
        #primero{
            display:none;
        }
        </style>
        <form action='registroUsuarios.php' method='POST' id='primero'> 
        <input value=$nombre type='text' name='Nombre' id='Nombre' placeholder='Nombre' class='fa' style='font-family: 'FontAwesome', 'Arial';' required>
        <input value=$apellido type='text' name='Apellido' id='Apellido' placeholder='&#xf007; Apellido' class='fa' style='font-family: 'FontAwesome', 'Arial';' required> 
        input value=$emai type='Email' name='Email' id='Email' placeholder='&#xf0e0; Email' class='fa' required
        pattern='[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-]([\.]?[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-])+@[a-zA-Z0-9]([^@&%$\/\(\)=?¿!\.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?'>
        <input value=$dni type='text' name='DNI' id='DNI' placeholder='&#xf2c2; DNI' class='fa' style='font-family: 'FontAwesome', 'Arial';' required minlength='7'>
        <input value=$clave type='password' name='clave' id='clave' placeholder='&#xf023; Contraseña' class='fa' style='font-family: 'FontAwesome', 'Arial';' required>
        <input value=$repetir_clave type='password' name='repetir_clave' id='repetir_clave' placeholder='&#xf023; Repetir contraseña' class='fa' style='font-family: 'FontAwesome', 'Arial';' required>
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
        <form action='registroUsuarios.php' method='POST' id='primero'> 
        <input value=$nombre type='text' name='Nombre' id='Nombre' placeholder='Nombre' class='fa' style='font-family: 'FontAwesome', 'Arial';' required>
        <input value=$apellido type='text' name='Apellido' id='Apellido' placeholder='&#xf007; Apellido' class='fa' style='font-family: 'FontAwesome', 'Arial';' required> 
        input value=$emai type='Email' name='Email' id='Email' placeholder='&#xf0e0; Email' class='fa' required
        pattern='[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-]([\.]?[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-])+@[a-zA-Z0-9]([^@&%$\/\(\)=?¿!\.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?'>
        <input value=$dni type='text' name='DNI' id='DNI' placeholder='&#xf2c2; DNI' class='fa' style='font-family: 'FontAwesome', 'Arial';' required minlength='7'>
        <input type='password' name='clave' id='clave' placeholder='&#xf023; Contraseña' class='fa' style='font-family: 'FontAwesome', 'Arial';' required>
        <input type='password' name='repetir_clave' id='repetir_clave' placeholder='&#xf023; Repetir contraseña' class='fa' style='font-family: 'FontAwesome', 'Arial';' required>
        <input type='submit' value='Registrarse'>
        </form>
        ");
        ?>
<script type='text/javascript'>
document.getElementById('resultado').innerHTML = 'Las contraseñas no coinciden';

// Recargar la página después de 3 segundos (3000 milisegundos)
setTimeout(function() {
    window.location.reload();
    // Volver atrás después de recargar la página
    setTimeout(function() {
        window.history.back();
    }, 100); // Puedes ajustar el tiempo de espera según tus necesidades
}, 3000);
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
document.getElementById("resultado").innerHTML =
    "El usuario se ha registrado correctamente (Seras redireccionado en 5 segundos)";
document.getElementById("resultado").style.color = "green";
</script>

<?php
            
         
            
            try {
                $nuevaAlerta = "Bienvenido a la Bolsa de trabajo de PROFITECH, Podras empezar a utilizarla en cuanto un Administrado te valide la cuenta";
                $vista = 1;

                $sentenciaInsert = $conexion->prepare("INSERT INTO Alertas (Alerta, DNI_CIF, Vista) VALUES (?, ?, ?)");
                $sentenciaInsert->bindParam(1, $nuevaAlerta);
                $sentenciaInsert->bindParam(2, $dni);
                $sentenciaInsert->bindParam(3, $vista);
                $sentenciaInsert->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }


            sleep(5);
            header ("Refresh:5;url=/index.html");
        } catch (PDOException $e) {

            echo (" 
            <style>
            #primero{
                display:none;
            }
            </style>
            <form action='registroUsuarios.php' method='POST'> 
            <input value=$nombre type='text' name='Nombre' id='Nombre' placeholder='Nombre' class='fa' style='font-family: 'FontAwesome', 'Arial';' required>
            <input value=$apellido type='text' name='Apellido' id='Apellido' placeholder='&#xf007; Apellido' class='fa' style='font-family: 'FontAwesome', 'Arial';' required> 
            <input type='Email' name='Email' id='Email' placeholder='&#xf0e0; Email' class='fa' required
            pattern='[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-]([\.]?[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-])+@[a-zA-Z0-9]([^@&%$\/\(\)=?¿!\.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?'>
            <input type='text' name='DNI' id='DNI' placeholder='&#xf2c2; DNI' class='fa' style='font-family: 'FontAwesome', 'Arial';' required minlength='7'>
            <input value=$clave type='password' name='clave' id='clave' placeholder='&#xf023; Contraseña' class='fa' style='font-family: 'FontAwesome', 'Arial';' required>
            <input value=$repetir_clave type='password' name='repetir_clave' id='repetir_clave' placeholder='&#xf023; Repetir contraseña' class='fa' style='font-family: 'FontAwesome', 'Arial';' required>
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
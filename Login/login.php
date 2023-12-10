<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel='stylesheet' href='../style.css' type='text/css' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body>
    <script src="https://kit.fontawesome.com/641620888d.js" crossorigin="anonymous"></script>
    <div class='FlexContainer'>
        <header>
            <div id="divuno">
                <div>
                    <img src="../img/logo_cpifp.png" alt="imagen del cpifp bajo aragon">
                    <img src="../img/logo_gob_eu.png" alt="Imagen gobierno de aragon">
                </div>
                <div id="button">
                    <a href="../Login/login.php"><button id="boton_login">
                            Iniciar Sesion
                        </button></a>
                    <a href="../Registro/index.html"><button id="boton_registro">
                            Registrarse
                        </button></a>
                </div>
            </div>
        </header>

        <div id="pagina_login">


            <div id="izquierda_pagina_login">
                <div  id="pagina_login_uno">
                <h2>¿No tienes una cuenta?</h2>
                <p>Registrate ahora siguiendo estos pasos</p>
                </div>
                
                <div class="izquierda_login" id="pagina_login_dos">
                    <h2>1.</h2>
                </div>
                <div class="izquierda_login" id="pagina_login_tres">
                    <p class="">Vaya al apartado Registrarse situado arriba a la derecha</p>
                </div>
                <div class="izquierda_login" id="pagina_login_cuatro">
                    <h2>2.</h2>
                </div>
                <div class="izquierda_login" id="pagina_login_cinco">
                
                    <p class="">Continue seleccionando el perfil que mas se ajuste a usted</p>
                </div>
                <div class="izquierda_login" id="pagina_login_seis">
                 <h2>3.</h2>
                </div>
                <div class="izquierda_login" id="pagina_login_siete">
                    <p class="">Por ultimo Inicie sesion e ingrese en una de las mayores plataformas de ofertas</p>
                </div>
            </div>



            <div id="login">
                <form action="login.php" method="post">
                    <input type="email" name="email" id="email-login" placeholder="Email" required>
                    <input type="password" name="passw" placeholder="Contraseña" id="password" required>
                    <a id="viewPassword"><i class="fa fa-eye" aria-hidden="true"></i>   </a>

                    <input class="boton_login" type="submit" name="login" value="Entrar">  
                    <p id="resultado_login"></p>

                </form>


<script>
    let password = document.getElementById('password');
let viewPassword = document.getElementById('viewPassword');
let click = false;

viewPassword.addEventListener('click', (e)=>{
  if(!click){
    password.type = 'text'
    click = true
  }else if(click){
    password.type = 'password'
    click = false
  }
})
</script>
            </div>
        </div>
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
<?php
        
        include "../Funciones/conexion-inicio.php";

?>

<?php
        session_start();

        $email = $_POST['email'];
        $pass = $_POST["passw"];
       
        $passwd = hash('sha256', $pass);


        $sql="SELECT * FROM Usuario WHERE Email=? and Clave=?";
        $consulta=$conexion->prepare($sql);
        $consulta->bindParam(1, $email);
        $consulta->bindParam(2, $passwd);
        $consulta->execute();
        $numFilas=$consulta->rowCount();
        if($numFilas==1){
            $fila = $consulta->fetch(PDO::FETCH_OBJ);
            echo "Hola ".$fila->Nombre_Usuario;
            echo "<br>";
            echo "Tu DNI_CIF es: ".$fila-> DNI_CIF;
            echo "<br>";
            echo "Tipo usuario: ".$fila-> Tipo_Usuario;
            //VARIABLES DE SESION
            $_SESSION['Email']=$fila-> Email;
            $_SESSION['Nombre_Usuario']=$fila-> Nombre_Usuario;
            $_SESSION['Tipo_Usuario']=$fila-> Tipo_Usuario;
            $_SESSION['dni']=$fila-> DNI_CIF;


            if($_SESSION['Tipo_Usuario']=='Alumno'){
                echo "Alumno";
                echo "<br>";
                header("Location: ../Inicio/Inicio_Alumno/index.php");
                exit;
            }else if($_SESSION['Tipo_Usuario']=='Empresa'){
                echo "Empresa";
                echo "<br>";
                header("Location: ../Inicio/Inicio_Empresa/index.php");
                exit;
            }else if($_SESSION['Tipo_Usuario']=='Admin'){
                echo "Admin";
                echo "<br>";
                header("Location: ../Inicio/Inicio_Admin/index.php");
                exit;
            }
        }else if($numFilas==0 and !empty($_POST['login'])) {
           ?>
           <script>
             document.getElementById("resultado_login").innerHTML = "Email y/o Contraseña incorrecto"; 
           </script>
           
           <?php } ?>
</html>




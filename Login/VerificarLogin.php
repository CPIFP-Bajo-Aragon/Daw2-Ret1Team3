<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../Funciones/mostrar.js"></script>
    <?php
        include "../Funciones/conexion.php";
    ?>
</head>
<body>
    <?php
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
        }else if($numFilas==0){
            ?>
             <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css" class="css">
    <script src="../Funciones/mostrar.js"></script>
    
</head>
<body>

    <?php include "../Header/Cabecera.php"; ?>

<div class="gridContainer">
    <div class="leftGrid">
        <div class="content">
            
            <div class="imageContainer">
                <img src="../Imagenes/oficinaImage.jpg" alt="">
            </div>
        </div>
    </div>
   
    <div class="rightGrid">
    <p>
        Login Usuario -> oscar@oscar.es Clave -> oscar
    </p>
    <p>
        Login Empresa -> prueba1@prueba.es Clave -> prueba
    </p>
        <div class="content">
          <div class="loginForm">
                <form action="VerificarLogin.php" method="post">
                <p>Login</p>

                    <input type="email" name="email" id="" placeholder="Email" required>

                    <input  type="password" name="passw" placeholder="Contraseña" id="password" required>

                    <input id="password-button" type="button" onclick="mostrar()" value="Mostrar contraseña">
                    <input type="submit" name="login" value="Entrar">
                </form>
          </div>
        </div>
    </div>
</div>

    <?php include "../Footer/footer.php"; ?>

</body>
</html>

            <?php


        }else{
            echo "Fatal error";
        }
        
    ?>
</body>
</html>
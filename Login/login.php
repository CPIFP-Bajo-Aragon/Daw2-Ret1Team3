<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css" class="css">
    <script src="../Funciones/mostrar.js"></script>
    gf
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
        <div class="content">
          <div class="loginForm">
                <form action="VerificarLogin.php" method="post">
                <p>Login</p>

                    <input value="oscar@oscar.es" type="email" name="email" id="" placeholder="Email" required>

                    <input  value="oscar" type="password" name="passw" placeholder="Contraseña" id="password" required>

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

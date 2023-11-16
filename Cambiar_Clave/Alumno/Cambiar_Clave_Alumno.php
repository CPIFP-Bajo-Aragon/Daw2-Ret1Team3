<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar contraseña</title>

</head>

<body>
    <link rel="stylesheet" href="../../Estilos/alumno.css">

    <header class="main-header">
        <img src="../../Imagenes/Profitech.png" alt="">
        <div class="conInfo">

            <p>Hola,
                <?php
                session_start();
                $dni = $_SESSION['dni'];
                $username = $_SESSION['Nombre_Usuario'];
                echo $_SESSION['Nombre_Usuario'] ?>
            </p>
            <form action="cerrarSesion.php" method="post">
                <input type="submit" value="Cerrar sesión" />
            </form>
        </div>
    </header>
    <main>
        <?php include "../../Header/CabeceraLogeado.php"; ?>
        <div class="main-content">
            <nav class="main-menu">
                <ul>
                    <a href="../../Inicio/Inicio_Alumno/index.php">
                        <li id="Inicio">Inicio</li>
                    </a>
                    <a href="../../Alumno/Curriculum/curriculum.php">
                        <li>Curriculum</li>
                    </a>
                    <a href="../../Alumno/Alertas/index.php">
                        <li>Mis alertas</li>
                    </a>
                    <a href="../../Alumno/Mensajes/mensaje.php">
                        <li>Mensajes</li>
                    </a>
                    <a href="../../Alumno/Mis_Ofertas/ofertas.php">
                        <li>Mis ofertas</li>
                    </a>
                    <hr>
                    <a href="../../Alumno/Buscar_Empresas/index.php">
                        <li>Buscar empresas</li>
                    </a>
                    <a href="../../Alumno/Buscar_Ofertas/index.php">
                        <li>Buscar ofertas</li>
                    </a>
                    <hr>
                    <a href="../../Cambiar_Clave/Alumno/Cambiar_Clave_Alumno.php">
                        <li>Cambiar contraseña</li>
                    </a>

                </ul>
            </nav>
            <section class="main-info">
                <div class="breadcrumbs">
                    <h1 id="breadcrumbs-title">Alumno / <span>Cambiar contraseñas</span></h1>
                    <div class="breadcrumb-dropdown enlace-caja">
                        <ul>
                            <li></li>
                            <li><a href="#datosPrincipales">Datos principales</a></li>
                            <li><a href="#titulaciones">Titulaciones</a></li>
                            <li><a href="#formacionComplementaria">Formación complementaria</a></li>
                            <li><a href="#experiencia">Experiencia</a></li>
                            <li><a href="#habilidadesPersonales">Habilidades personales</a></li>
                            <li><a href="#habilidadesBasicas">Habilidades básicas</a></li>
                            <li><a href="#idiomas">Idiomas</a></li>
                        </ul>
                    </div>
                </div>
                <form action="Cambiar_Clave_Alumno.php" method="post">
                    <p>Camabiar Contraseña</p>
                    <input type="password" name="pssw_old" id="pssw_old" placeholder="Contraseña Actual" required>
                    <input type="password" name="passw" placeholder="Nueva Contraseña" id="password">
                    <input type="password" name="passwnew" placeholder="Repite la nueva Contraseña" id="passwordnew">

                    <input type="submit" name="login" value="Entrar">
                </form>
                <p id="resultado">

                </p>


                <?php
                include "../Funciones/conexion.php";
                session_start();

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $pssw_old = $_POST['pssw_old'];
                    $pass_nueva = $_POST["passw"];
                    $pass_nueva_dos = $_POST["passwnew"];

                    $dni = $_SESSION['dni'];
                    $passwd_old = hash('sha256', $pssw_old);
                    $pass_nueva_hash = hash('sha256', $pass_nueva);

                    $sql_verificar = "SELECT DNI_CIF FROM Usuario WHERE DNI_CIF=? AND Clave=?";
                    $consulta_verificar = $conexion->prepare($sql_verificar);
                    $consulta_verificar->bindParam(1, $dni);
                    $consulta_verificar->bindParam(2, $passwd_old);

                    $consulta_verificar->execute();
                    $numFilas = $consulta_verificar->rowCount();


                    if ($numFilas == 0) {
                        ?>
                        <script>
                            document.getElementById("resultado").innerHTML = "Contraseña introducida incorrecta";
                        </script>
                        <?php
                    }
                    if ($pass_nueva != $pass_nueva_dos) {
                        ?>
                        <script>
                            document.getElementById("resultado").innerHTML = "Las contraseñas no coinciden";
                        </script>
                        <?php
                    }
                    if (($numFilas == 1) and ($pass_nueva == $pass_nueva_dos)) {
                        $sql_update = "UPDATE Usuario SET Clave=? WHERE DNI_CIF=?";
                        $consulta_update = $conexion->prepare($sql_update);
                        $consulta_update->bindParam(1, $pass_nueva_hash);
                        $consulta_update->bindParam(2, $dni);
                        $consulta_update->execute();
                        ?>
                        <script>
                            document.getElementById("resultado").innerHTML = "Contraseña Cambiada correctamente";
                        </script>
                        <?php
                    }
                }
















                ?>
            </section>
        </div>
        <div class="footer">
            <?php include "../../Footer/footer.php"; ?>
        </div>
    </main>

</body>

</html>
<?php
include "../../Funciones/conexion.php";
session_start();

if (!isset($_SESSION['dni'])) {
    header("Location: ../../index.php");
    exit();
}

$dni = $_SESSION['dni'];
$username = "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../Estilos/alumno.css">
</head>
<body>
    <main>
        <header class="main-header">
            <img src="../../Imagenes/Profitech.png" alt="">
            <div class="conInfo">
                <p>Hola, <?php echo $username ?></p>
                <form action="cerrarSesion.php" method="post">
                    <input type="submit" value="Cerrar sesión"/>
                </form>
            </div>
        </header>
        <div class="main-content">
            <nav class="main-menu">
                <ul>
                    <a href="#"><li id="Inicio">Inicio</li></a>
                    <a href="../../Alumno/Curriculum/curriculum.php"><li>Curriculum</li></a>
                    <a href="../../Alumno/Alertas/index.php"><li>Mis alertas</li></a>
                    <a href="#"><li>Mensajes</li></a>
                    <a href="../../Inicio/Inicio_Alumno/Mis_Ofertas/ofertas.php"><li>Mis ofertas</li></a>
                    <hr>
                    <a href="../../Alumno/Buscar_Empresas/index.php"><li>Buscar empresas</li></a>
                    <a href="../../Alumno/Buscar_Ofertas/index.php"><li>Buscar ofertas</li></a>
                    <hr>
                    <a href="../../Cambiar_Clave/Alumno/Cambiar_Clave_Alumno.php"><li>Cambiar contraseña</li></a>

                </ul>
            </nav>
            <section class="main-info">
            <article class="card">
            <p id="resultado"></p>
            </article>

                <?php 
                $sql = "SELECT * FROM Alertas where DNI_CIF = '$dni' AND Vista=1";
                
                if ($result = $conexion->query($sql)) {
                    $sqlfilas = $result->rowCount();
                   
                    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                        $Id_Alerta = $row->Id_Alerta;
                        $Alerta = $row->Alerta;
                        ?>
                        <article class="card">
                            <p><?php echo $Alerta ?></p>
                            <form action="desactivaralerta.php" method="POST"> 
                                <input type="hidden" name="id" value="<?php echo $Id_Alerta?>">
                                <input type="submit" value="Marcar como Leída" />
                            </form>
                        </article>

                        <?php
                    }
                }
                if ($sqlfilas==0){
                    ?>
                    <script>
                        document.getElementById("resultado").innerHTML = "No tienes alertas actualmente :)";
                    </script>
                    <?php
                }
                ?>
                
            </section>
        </div>
    </main>
</body>
</html>

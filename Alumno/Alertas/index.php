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
                    <li><a href="#">Inicio</a></li>
                    <li><a href="../../Alumno/Curriculum/curriculum.php">Curriculum</a></li>
                    <li><a href="#">Mis alertas</a></li>
                    <li><a href="#">Mensajes</a></li>
                    <li><a href="#">Mis ofertas</a></li>
                    <hr>
                    <li><a href="../../Alumno/Buscar_Empresas/index.php">Buscar empresas</a></li>
                    <li><a href="../../Alumno/Buscar_Ofertas/index.php">Buscar ofertas</a></li>
                    <hr>
                    <li><a href="../../Cambiar_Clave/Alumno/Cambiar_Clave_Alumno.php">Cambiar contraseña</a></li>
                </ul>
            </nav>
            <section class="main-info">
                <?php 
                $sql = "SELECT * FROM Alertas where DNI_CIF = '$dni' AND Vista=1";

                if ($result = $conexion->query($sql)) {
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
                ?>
            </section>
        </div>
    </main>
</body>
</html>

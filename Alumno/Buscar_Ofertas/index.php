<link rel="shortcut icon" href="../../Imagenes/icon/icon.png">
<!DOCTYPE html>
<html lang="es">

<?php
session_start();
$dni = $_SESSION['dni'];
$username = $_SESSION['Nombre_Usuario'];

function cerrarSesion(){
    session_destroy();
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="alumno.css">
    <style>
        .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.7);
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

.cerrar {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.cerrar:hover,
.cerrar:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
    </style>
</head>

<body>
    <main>
        <header class="main-header">
            <img src="../../Imagenes/Profitech.png" alt="">
            <div class="conInfo"><p>Hola, <?php echo $username ?></p>
            <form action="cerrarSesion.php" method="post">
            <input type="submit" value="Cerrar sesión"/>
            </form>
            </div>
        </header>
        <div class="main-content">
            <nav class="main-menu">
                <ul>
                    <li><a href="../../Inicio/Inicio_Alumno/index.php">Inicio</a></li>
                    <li><a href="../../Alumno/Curriculum/curriculum.php">Curriculum</a></li>
                    <li><a href="#">Mis alertas</li>
                    <li><a href="#">Mensajes</a></li>
                    <li><a href="#">Mis ofertas</a></li>
                    <hr>
                    <li><a href="../Buscar_Empresas/index.php">Buscar empresas</a></li>
                    <li><a href="index.php">Buscar ofertas</a></li>
                    <hr>
                    <li><a href="#">Cambiar contraseña</a></li>
                </ul>
            </nav>
            <section class="main-info">
            <h1>Buscar Ofertas</h1>
            <article class="card">
                    <h2 class="card-title">Titulaciones</h2>
                        <hr class="hr-divider">
                    <div class="cardContent">
                        <div class="cardInfo">
                        <?php include "buscar_ofertas.php"?>
                        </div>
                    </div>
            </article>
            </section>
        </div>
        <div class="footer">
        <?php include "../../Footer/footer.php"; ?>
        </div>
    </main>
</body>
</html>
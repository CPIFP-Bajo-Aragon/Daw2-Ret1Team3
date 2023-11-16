<link rel="stylesheet" href="../../Estilos/estilocabeceraLogeado.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<header class="main-header">
    
            <img src="../../Imagenes/Profitech.png" alt="">
            <div class="conInfo">
                <p>Hola, <?php echo $username ?></p>
                <form action="cerrarSesion.php" method="post">
                    <input type="submit" value="Cerrar sesión"/>
                </form>
            </div>
</header>
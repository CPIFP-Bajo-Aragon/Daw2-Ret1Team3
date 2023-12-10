<head>
    <link rel="stylesheet" href="../Estilos/alumno.css">
</head>
<header>
    <div id="segmento">
        <div id="cabecera">
            <div class="apartados-cabecera" id="cabeceradivuno">
                <img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSIFBM_RfGw9iTC9YkHoT9JVjD9BhVI3TEvKIOJbyAptxao9iah"
                    alt="logo pagina">
                <p>Bolsa de Empleo</p>
            </div>
            <div class="apartados-cabecera" id="cabeceradivdos">
            <div id="hamburguesa">
                    <div class="barra"></div>
                    <div class="barra"></div>
                    <div class="barra"></div>
                </div>
            </div>
            <div class="apartados-cabecera" id="cabeceradivtres">
                <p>Bienvenido,
                    <?php echo $username ?> 👋
                </p>
                
                <form method="post" action="">
                    <button type="submit" name="cerrarSesion">Cerrar Sesión</button>
                </form>
            </div>
        </div>
        <div id="frase">
            <p>
                "Listo para el próximo desafío laboral. ¡Vamos juntos hacia el éxito!"
            </p>
        </div>
    </div>
</header>
<?php
if (isset($_POST['cerrarSesion'])) {
    session_unset();
    session_destroy();
    header("Location: /");
    exit();
}

?>
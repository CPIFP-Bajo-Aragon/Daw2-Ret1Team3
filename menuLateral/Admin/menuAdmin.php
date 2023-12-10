<style>
.main-menu li {
    font-size: 15px;
    margin-top: -5px;
}
</style>
<nav class="main-menu">
    <ul>
        <a href="../../Inicio/Inicio_Admin/index.php">
            <li id="Inicio"><i class="material-icons">home</i> Inicio</li>
        </a>
        <hr>
        <a href="../../Admin/Alertas/index.php">
            <li><i class="material-icons">notifications</i><span id="num_alerta">Mis Alertas:
                    <?php echo $_SESSION['numalertas']?>
                </span></li>
        </a>
        <a href="../../Admin/Mensajes/mensaje.php">
            <li><i class="material-icons">email</i>Mensajes</li>
        </a>
        <hr>
        <a href="../../Admin/Gestion_Empresa/index.php">
            <li><i class="material-icons">business</i> Gestión de empresas</li>
        </a>
        <a href="../../Admin/Gestion_Usuario/index.php">
            <li><i class="material-icons">people</i> Gestión de alumnos</li>
        </a>
        <a href="../../Admin/Gestion_Oferta/index.php">
            <li><i class="material-icons">description</i> Gestión de ofertas</li>
        </a>
        <hr>
        <a href="../../Admin/Validar_Empresa/index.php">
            <li><i class="material-icons">check_circle</i> Activar empresa</li>
        </a>
        <a href="../../Admin/Validar_Usuario/index.php">
            <li><i class="material-icons">check_circle</i> Activar alumno</li>
        </a>
        <a href="../../Admin/Validar_oferta/index.php">
            <li><i class="material-icons">check_circle</i> Activar oferta</li>
        </a>
        <hr>
        <a href="../../Admin/Crear_Admin/index.php">
            <li><i class="material-icons">person_add</i> Crear administrador</li>
            <a href="../../Admin/Crear_Usuario/index.php">
                <li><i class="material-icons">person_add</i> Crear Alumno</li>
            </a>
            <a href="../../Admin/Crear_Empresa/index.php">
                <li><i class="material-icons">person_add</i> Crear Empresa</li>
            </a>
            <a href="../../Admin/Crear_Oferta/index.php">
                <li><i class="material-icons">person_add</i> Crear Oferta</li>
            </a>
            <hr>
            <a href="../../Admin/Editar_Usuario/index.php">
                <li><i class="material-icons">edit</i> Editar Alumno</li>
            </a>
            <a href="../../Admin/Editar_Empresa/index.php">
                <li><i class="material-icons">edit</i> Editar Empresa</li>
            </a>
            <a href="../../Admin/Editar_Oferta/index.php">
                <li><i class="material-icons">edit</i> Editar Ofertas</li>
            </a>
            <hr>
            <a href="../../Cambiar_Clave/Admin/Cambiar_Clave_Admin.php">
                <li><i class="material-icons">vpn_key</i> Cambiar contraseña</li>
            </a>
            <hr>
            <a href="../../Admin/Reportes/index.php">
                <li><i class="material-icons">receipt_long</i> Reportes</li>
            </a>
    </ul>

</nav>
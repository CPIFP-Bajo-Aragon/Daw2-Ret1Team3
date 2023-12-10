 <nav class="main-menu">
     <ul>
         <a href="../../Inicio/Inicio_Empresa/index.php">
             <li id="Inicio"><i class="material-icons">home</i> Inicio</li>
         </a>
         <a href="../../Empresa/Alertas/index.php">
             <li><i class="material-icons">notifications</i><span id="num_alerta">Mis Alertas:
                     <?php echo $_SESSION['numalertas']?></span></li>
         </a>
         <a href="../../Empresa/Mensajes/mensaje.php">
             <li><i class="material-icons">email</i> Mensajes</li>
         </a>
         <a href="../../Empresa/Crear_Oferta/Crear_Oferta.php">
             <li><i class="material-icons">post_add</i> Crear ofertas</li>
         </a>
         <a href="../../Empresa/Mis_Ofertas/ofertas.php">
             <li><i class="material-icons">work</i> Mis ofertas</li>
         </a>
         <hr>
         <a href="../../Empresa/Listar_Candidatos/index.php">
             <li><i class="material-icons">search</i> Buscar candidatos</li>
         </a>
         <hr>
         <a href="../../Cambiar_Clave/Empresa/Cambiar_Clave_Empresa.php">
             <li><i class="material-icons">vpn_key</i> Cambiar contraseña</li>
         </a>
     </ul>
 </nav>
 <style>
            .main-menu li{
                margin-top: 15px;
                margin-bottom: 15px;
            }
         </style>
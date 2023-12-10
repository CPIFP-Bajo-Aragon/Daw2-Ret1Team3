         <nav class="main-menu">
             <ul>
                 <a href="../../Inicio/Inicio_Alumno/index.php">
                     <li id="Inicio"><i class="material-icons">home</i> Inicio</li>
                 </a>
                 <a href="../../Alumno/Curriculum/curriculum">
                     <li><i class="material-icons">description</i> Curriculum</li>
                 </a>
                 <a href="../../Alumno/Alertas/index.php">
                     <li><i class="material-icons">notifications</i><span id="num_alerta">Mis Alertas:
                             <?php echo $_SESSION['numalertas']?></span></li>
                 </a>
                 <a href="../../Alumno/Mensajes/mensaje">
                     <li><i class="material-icons">email</i> Mensajes</li>
                 </a>
                 <a href="../../Alumno/Mis_Ofertas/ofertas">
                     <li><i class="material-icons">work</i> Mis ofertas</li>
                 </a>
                 <hr>
                 <a href="../../Alumno/Buscar_Empresas/index">
                     <li><i class="material-icons">business</i> Buscar empresas</li>
                 </a>
                 <a href="../../Alumno/Buscar_Ofertas/index">
                     <li><i class="material-icons">search</i> Buscar ofertas</li>
                 </a>
                 <hr>
                 <a href="../../Cambiar_Clave/Alumno/Cambiar_Clave_Alumno">
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
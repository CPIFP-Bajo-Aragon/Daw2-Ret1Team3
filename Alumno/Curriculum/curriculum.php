    <?php 
    include "../../Funciones/conexion.php";
    session_start();
    $dni = $_SESSION['dni'];
    $username = $_SESSION['Nombre_Usuario'];
    include "../../Funciones/SessionStart.php";
    ?>
    <html>

    <head>
        <link rel="stylesheet" href="../../Estilos/curriculum.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../../Inicio/Inicio_Alumno/alumno.css">
    </head>

    <body>
        <main>
            <header class="main-header">
                <img src="../../Imagenes/Profitech.png" alt="">
                <div class="conInfo">
                <div class="conInfo"><p>Hola, <?php echo $username ?></p>
                    <form action="cerrarSesion.php" method="post">
                        <input type="submit" value="Cerrar sesión" />
                    </form>
                </div>
            </header>
            <div class="main-content">
                <nav class="main-menu">
                    <ul>
                        <!-- Mister CSS Areggla las url-->
                        <li><a href="../../Inicio/Inicio_Alumno/">Inicio</a></li>
                        <li><a href="../../Alumno/Curriculum/curriculum.php">Curriculum</a></li>
                        <li><a href="#">Mis alertas</li>
                        <li><a href="#">Mensajes</a></li>
                        <li><a href="#">Mis ofertas</a></li>
                        <hr>
                        <li><a href="../Buscar_Empresas/index.php">Buscar empresas</a></li>
                        <li><a href="../Buscar_Ofertas/index.php">Buscar ofertas</a></li>
                        <hr>
                        <li><a href="#">Cambiar contraseña</a></li>
                    </ul>
                </nav>
                <section class="main-info">
                <article class="card">

    
                <?php


    $queryalumno = "SELECT * FROM Alumno WHERE DNI_CIF='$dni'";

    if ($resultalumno = $conexion->query($queryalumno)) {
        while ($rowalumno = $resultalumno->fetch(PDO::FETCH_OBJ)) {
            $Apellido = $rowalumno->Apellido;
            $Fecha_Nacimiento = $rowalumno->Fecha_Nacimiento;
            $Telefono_Alumno = $rowalumno->Telefono_Alumno;
            $Foto_Alumno = $rowalumno->Foto_Alumno;
            $Movilidad = $rowalumno->Movilidad;
            $Direccion = $rowalumno->Direccion;
            $Perfil_Publico = $rowalumno->Perfil_Publico;
            $id_Municipio_usuario = $rowalumno->Id_Municipio;


        }
    }

    $querydni = "SELECT * FROM Usuario WHERE DNI_CIF='$dni'";

    if ($resultdni = $conexion->query($querydni)) {
        while ($rowdni = $resultdni->fetch(PDO::FETCH_OBJ)) {
            $Nombre_Usuario = $rowdni->Nombre_Usuario;
        }
    }

    $querymunicipio = "SELECT * FROM Municipio where Id_Municipio=$id_Municipio_usuario"; 
    if ($resultmunicipio = $conexion->query($querymunicipio)) {
        while ($rowmunicipio = $resultmunicipio->fetch(PDO::FETCH_OBJ)) {
            $Nombre_Municipio = $rowmunicipio->Nombre_Municipio;
            $id_Municipio = $rowmunicipio->Id_Municipio;

        }
    }


    $queryemail="SELECT Email FROM Usuario WHERE DNI_CIF='$dni'";
    if ($resultemail = $conexion->query($queryemail)) {
        while ($rowemail = $resultemail->fetch(PDO::FETCH_OBJ)) {
            $email = $rowemail -> Email;
        }

    }

        
    ?>
    <div class="div1">
    <?php

        echo "<h1>Datos Personales</h1>";
        echo "<img src='../../Inicio/Inicio_Alumno/Datos_principales/FotosAlumnos/$dni.png' alt='Imagen icono'>";
        echo "<p>Nombre: ".$Nombre_Usuario."</p>";
        echo "<p>Apellidos: ".$Apellido."</p>";
        echo "<p>Fecha Nacimiento: ".$Fecha_Nacimiento."</p>";
        echo "<p>Direccion: ".$Direccion."</p>";
        echo "<p>Municipio: ".$Nombre_Municipio."</p>";
        echo "<p>Movilidad: ".$Movilidad."</p>";
    ?>
    </div>
    <?php 

    ?>
    <div class="div2">
    <?php


        echo "<h1>Contacto</h1>";
        echo "<p>Telefono: ".$Telefono_Alumno."</p>";
        echo "<p>Correo: ".$email."</p>";

    ?>
    </div>
    <?php           

    echo "<h1>Experiencia Laboral</h1>";
    $queryexplab="SELECT * FROM Experiencia_Laboral WHERE DNI_CIF='$dni'";
    if ($resultexplab = $conexion->query($queryexplab)) {
        while ($rowexplab = $resultexplab->fetch(PDO::FETCH_OBJ)) {
            $id = $rowexplab -> Id_Experiencia_Laboral;
            $Nombre_Empresa = $rowexplab->Nombre_Empresa;
            $Puesto = $rowexplab-> Puesto;
            $Descripcion = $rowexplab->Descripcion;
            $Fecha_Inicio_explab =  $rowexplab-> Fecha_Inicio;
            $Fecha_Fin_explab =  $rowexplab-> Fecha_Fin;


        
            ?>
            <div class="div3">
            <?php

                echo "<p>Nombre de la Empresa: ".$Nombre_Empresa."</p>";
                echo "<p>Puesto: ".$Puesto."</p>";
                echo "<p>Descripción: ".$Descripcion."</p>";
                echo "<p>Fecha Inicio: ".$Fecha_Inicio_explab."</p>";
                echo "<p>Fecha Fin: ".$Fecha_Fin_explab."</p>";
                ?>
                </div>
                <?php
        }
        }

        $queryidioma="SELECT Idioma.Idioma, Nivel.Nivel, Idioma.Id_Idioma
        FROM Idioma
        JOIN Nivel_Idioma ON Idioma.Id_Idioma = Nivel_Idioma.Id_Idioma
        JOIN Nivel ON Nivel.Id_Nivel = Nivel_Idioma.Id_Nivel
        WHERE Nivel_Idioma.DNI_CIF = '$dni'";


        echo "<h1>Idioma</h1>";
        if ($resultidioma = $conexion->query($queryidioma)) {
            while ($rowidioma = $resultidioma->fetch(PDO::FETCH_OBJ)) {
                $Idioma = $rowidioma -> Idioma;
                $Nivel = $rowidioma->Nivel;
                $Id_Idioma = $rowidioma->Id_Idioma;
        
                ?>
                <div class="div4">
                <?php
                echo "<p>Idioma: ".$Idioma."</p>";
                echo "<p>Tipo: ".$Nivel."</p>"; 
                ?>
                </div>
                <?php
            }
        
        }

        echo "<h1>Formacion Complementaria</h1>";
        $queryformacion="SELECT * FROM Formacion_Complementaria";
        if ($resultformacion = $conexion->query($queryformacion)) {
            while ($rowformacion = $resultformacion->fetch(PDO::FETCH_OBJ)) {
                $Id_Formacion = $rowformacion -> Id_Formacion_Complementaria;
                $Nombre_Formacion = $rowformacion->Nombre;
                $Entidad_emisora = $rowformacion-> Entidad_Emisora;
                $Fecha_Inicio_formacion =  $rowformacion-> Fecha_Inicio;
                $Fecha_Fin_formacion =  $rowformacion-> Fecha_Fin;
                $Fecha_Caducidad_formacion =  $rowformacion-> Fecha_Caducidad;
                $Num_Horas_formacion =  $rowformacion-> Num_Horas;


                ?>
                <div class="div5">
                <?php
                echo "<p>Nombre Formacion: ".$Nombre_Formacion."</p>";
                echo "<p>Enitdad Emisora: ".$Entidad_emisora."</p>";
                echo "<p>Fecha Inicio: ".$Fecha_Inicio_formacion."</p>";
                echo "<p>Fecha Fin: ".$Fecha_Fin_formacion."</p>";
                echo "<p>Fecha caducidad: ".$Fecha_Caducidad_formacion."</p>";
                echo "<p>Numero de horas: ".$Num_Horas_formacion."</p>";

                ?>
                </div>
                <?php
            }
        }

        $queryhard = "SELECT Hard_Skill.Id_Hard, Hard_Skill.nombre, Hard_Skill.tipo FROM Hard_Skill, Hard_Skill_Alumno WHERE Hard_Skill.Id_Hard=Hard_Skill_Alumno.Id_Hard AND DNI_CIF='$dni'; ";

        echo "<h1>Hard Skills</h1>";
        $prevTipo = null; 

        if ($resulthard = $conexion->query($queryhard)) {
            while ($rowhard = $resulthard->fetch(PDO::FETCH_OBJ)) {
                $Id_Hard = $rowhard->Id_Hard;
                $nombre_hard = $rowhard->nombre;
                $tipo_hard = $rowhard->tipo;

                if ($tipo_hard !== $prevTipo) { 
                    if ($prevTipo !== null) {
                        echo "</optgroup>";
                    }

                    echo "<optgroup label=\"$tipo_hard\">";
                    $prevTipo = $tipo_hard; 
                }


                echo "<option value=\"$Id_Hard\">$nombre_hard</option>";
  
            }

            if ($prevTipo !== null) {
                echo "</optgroup>";
            }
        }


        $querysoft = "SELECT Soft_Skill.Id_Soft, Soft_Skill.nombre FROM Soft_Skill, Soft_Skill_Alumno WHERE Soft_Skill.Id_Soft=Soft_Skill_Alumno.Id_Soft AND DNI_CIF='$dni'; ";

        echo "<h1>Soft Skills</h1>";
        if ($resultsoft = $conexion->query($querysoft)) {
            while ($rowsoft = $resultsoft->fetch(PDO::FETCH_OBJ)) {
                $Id_Soft = $rowsoft->Id_Soft;
                $nombre_soft = $rowsoft->nombre;
    
                ?>
                <div class="div6">
    <?php
                echo "<p>$nombre_soft<p>";
                ?>
                </div>
                <?php
            }
        }

        $querytitulo = "SELECT Centro.Nombre_Centro, Centro.Id_Centro, Titulacion_Centro_Persona.Fecha_Inicio, Titulacion_Centro_Persona.Fecha_Fin, Titulacion.Nombre, Titulacion.Id_Tipo_Titulacion FROM Centro, Alumno, Titulacion, Titulacion_Centro_Persona WHERE Centro.Id_Centro = Titulacion_Centro_Persona.Id_Centro AND Alumno.DNI_CIF = Titulacion_Centro_Persona.DNI_CIF AND Titulacion.Id_Tipo_Titulacion = Titulacion_Centro_Persona.Id_Tipo_Titulacion AND Alumno.DNI_CIF = :dni";

        $stmttitulo = $conexion->prepare($querytitulo);
        $stmttitulo->bindParam(':dni', $dni);
        $stmttitulo->execute();
        
        echo "<h1>Titulaciones</h1>";
            while ($rowtitulo = $stmttitulo->fetch(PDO::FETCH_ASSOC)) {
                $Id_Centro = $rowtitulo['Id_Centro'];
                $Id_Tipo_Titulacion = $rowtitulo['Id_Tipo_Titulacion'];
                $Fecha_Inicio = $rowtitulo['Fecha_Inicio'];

                $Nombre_Centro=$rowtitulo['Nombre_Centro'] ;
                $Fecha_Inicio_titulo=$rowtitulo['Fecha_Inicio'] ;
                $Fecha_Fin_titulo=$rowtitulo['Fecha_Fin'] ;
                $nombre_titulo=$rowtitulo['Nombre'] ;

                ?>
                                <div class="div7">
                        <?php

                echo "<p>Nombre del centro:</p>".$Nombre_Centro;
                echo "<p>Titulacion: ".$nombre_titulo."</p>";
                echo "<p>Fecha Inicio".$Fecha_Inicio_titulo."</p>";
                echo "<p>Fecha Fin".$Fecha_Fin_titulo."</p>";
            ?>
                    </div>
                <?php
                
            }


    ?>

            </article>

            </section>
    </body>

    </html>
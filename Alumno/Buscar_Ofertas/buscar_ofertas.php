<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "../../Funciones/conexion.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    
    <div id="Filtrar">
        <form action="index.php" method="post">
            <p>Empresa</p>
            <?php 
        $sql="SELECT * FROM Usuario WHERE Tipo_Usuario='Empresa'";

        if($resultado = $conexion -> query($sql)){
            ?>
            <select name="empresa" id="">
                <option value="">- Empresa -</option>

                <?php
            while($row = $resultado->fetch(PDO::FETCH_OBJ)){
                $empresa= $row-> Nombre_Usuario;
                $Id_empresa=$row-> DNI_CIF;
                ?>
                <option value="<?php echo $Id_empresa?>"><?php echo $empresa?></option>
                <?php 

            }
            ?>
            </select>
            <?php 
        }
        ?>
            <p>Area de negocio</p>
            <?php 
        $sql="SELECT * FROM AreasDeNegocio";
        if($resultado = $conexion -> query($sql)){
            ?>
            <select name="area_negocio" id="">
                <option value="">- Area de negocio -</option>

                <?php
            while($row = $resultado->fetch(PDO::FETCH_OBJ)){
                $Area_negocio= $row-> Nombre;
                $ID= $row-> ID;

                ?>
                <option value="<?php echo $ID?>"><?php echo $Area_negocio?></option>
                <?php 

            }
            ?>
            </select>
            <?php 
        }
        ?>
            <p>Idioma</p>
            <?php 
        $sql="SELECT * FROM Idioma";

        if($resultado = $conexion -> query($sql)){
            ?>
            <select name="idioma" id="">
                <option value="">- Idioma -</option>

                <?php
            while($row = $resultado->fetch(PDO::FETCH_OBJ)){
                $Idioma= $row-> Idioma;

                $Id_Idioma= $row-> Id_Idioma;
                ?>
                <option value="<?php echo $Id_Idioma?>"><?php echo $Idioma?></option>
                <?php 

            }
            ?>
            </select>
            <?php 
        }
                
        ?>
            <p>Titulacion</p>
            <?php 
        $sql="SELECT * FROM Titulacion";

        if($resultado = $conexion -> query($sql)){
            ?>
            <select name="titulacion" id="">
                <option value="">- Titulacion -</option>

                <?php
            while($row = $resultado->fetch(PDO::FETCH_OBJ)){
                $Titulacion= $row-> Nombre;

                $Tpo= $row-> Tipo;
                $Id_Titulacion= $row-> Id_Tipo_Titulacion;
                ?>
                <option value="<?php echo $Id_Titulacion?>"><?php echo $Tpo." - ".$Titulacion?></option>
                <?php 

            }
            ?>
            </select>
            <?php 
        }
                
        ?>
            <input type="submit" name="buscar" value="Buscar" >
            <input type="reset" value="Limpiar">
            
        </form>
        
    </div>
    <?php

        if(isset($_POST['buscar'])){
            $CIF_empresa=$_POST['empresa'];
            $Area_negocio=$_POST['area_negocio'];
            $Titulacion=$_POST['titulacion'];
            $Idioma=$_POST['idioma'];

            ?>
            <style>
                #nomostar{
                    display: none;
                }
            </style>
         <?php
            
        $sql ="SELECT DISTINCT Oferta.Id_Oferta, Oferta.Titulo, Oferta.Vacantes, Oferta.Descripcion, Oferta.Activo, Oferta.Fecha_Publicacion, Oferta.Fecha_Inicio, Oferta.Fecha_Fin, Oferta.DNI_CIF, Oferta.Id_Municipio, Usuario.Nombre_Usuario FROM Oferta, Oferta_Tipo_Titulacion, Titulacion, Empresa, Oferta_Nivel_Idioma, Idioma, Usuario WHERE Oferta.Activo=1 AND Oferta.Id_Oferta = Oferta_Tipo_Titulacion.Id_Oferta AND Titulacion.Id_Tipo_Titulacion = Oferta_Tipo_Titulacion.Id_Tipo_Titulacion AND Empresa.DNI_CIF=Oferta.DNI_CIF AND Oferta_Nivel_Idioma.Id_Idioma=Idioma.Id_Idioma AND Oferta_Nivel_Idioma.Id_Oferta=Oferta.Id_Oferta AND Oferta.DNI_CIF = Usuario.DNI_CIF";
            
        //     $sql="SELECT DISTINCT 
        //     O.Id_Oferta, 
        //     O.Titulo, 
        //     O.Vacantes, 
        //     O.Descripcion, 
        //     O.Activo, 
        //     O.Fecha_Publicacion, 
        //     O.Fecha_Inicio, 
        //     O.Fecha_Fin, 
        //     O.DNI_CIF, 
        //     O.Id_Municipio
        // FROM 
        //     Oferta AS O
        //     JOIN Oferta_Tipo_Titulacion AS OTT ON O.Id_Oferta = OTT.Id_Oferta
        //     JOIN Titulacion AS T ON T.Id_Tipo_Titulacion = OTT.Id_Tipo_Titulacion
        //     JOIN Empresa AS E ON E.DNI_CIF = O.DNI_CIF
        //     JOIN Oferta_Nivel_Idioma AS ONI ON ONI.Id_Oferta = O.Id_Oferta
        //     JOIN Idioma AS I ON ONI.Id_Idioma = I.Id_Idioma
        // WHERE 
        //     O.Activo = 1";
            
            
            if($CIF_empresa!=""){
                $sql = $sql." AND Oferta.DNI_CIF='$CIF_empresa'";               
            }
            if($Area_negocio!=""){
                $sql = $sql." AND Empresa.Area_Negocio='$Area_negocio'";
            }
            if($Titulacion  !=""){
                $sql = $sql." AND Titulacion.Id_Tipo_Titulacion='$Titulacion'";
            }
            if($Idioma  !=""){
                $sql = $sql." AND Idioma.Id_Idioma='$Idioma'";
            }
            if($CIF_empresa=="" && $Area_negocio=="" && $Titulacion=="" && $Idioma==""){
                $sql ="SELECT Oferta.Titulo, Oferta.Vacantes, Oferta.Fecha_Inicio, Oferta.Fecha_Fin, Usuario.Nombre_Usuario, Oferta.Descripcion, Oferta.Id_Oferta
                FROM Oferta, Usuario
                WHERE Oferta.Activo = 1 AND Oferta.DNI_CIF = Usuario.DNI_CIF";
            }

            //echo $sql;
            //sadfasdfbtasdy

            $leeroferta = $conexion -> query($sql);
        
            while($fila = $leeroferta->fetch(PDO::FETCH_OBJ)){
                echo "<div class=\"container\">";
                echo "<p class=\"info\">Empresa: ".$fila ->Nombre_Usuario."</p>";
                echo "<hr class=\"divider\">";
                echo "<p class=\"info\">Puesto de trabajo: ".$fila ->Titulo."</p>";
                echo "<p class=\"info\">Vacantes: ".$fila ->Vacantes."</p>";
                echo "<p class=\"info\">Fecha inicio: ".$fila ->Fecha_Inicio."</p>";
                echo "<p class=\"info\">Descripcion: ".$fila ->Descripcion."</p>"; 

                ?>
                <button class="abrirModal">Ver Oferta</button>
                    <div class="ventanaModal modal">
                        <div class="modal-content">
                            <span class="cerrar">&times;</span>
                            <?php 
                                echo "<h2>Empresa: ".$fila->Nombre_Usuario."</h2>";
                                echo "<p>Puesto de trabajo: ".$fila->Titulo."</p>";
                                echo "<p>Vacantes: ".$fila->Vacantes."</p>";
                                echo "<p>Fecha inicio: ".$fila->Fecha_Inicio."</p>";
                                echo "<p>Descripcion: ".$fila->Descripcion."</p>"; 
                                echo "<p>Idioma: ".$fila->Idioma." - ".$fila->nivel."</p>";
                                echo "<p>Titulacion: ".$fila->Nombre."</p>";
                                echo "<p>Soft skills: ".$fila->Nombre_soft."</p>";
                                echo "<p>Hard skills: ".$fila->Nombre_hard."</p>";
                            ?>
                        </div>
                    </div>

                <form action="" method="post">
                <input type="hidden" name="IdOferta" value="<?php echo $fila -> Id_Oferta?>">
                <input type="submit" name="inscribirse" value="Inscribirse">
                </form>
                <?php
                echo "</div>";
                ?>       
  
    <?php
             }
        }
    ?>

    <div id="nomostar">
    <?php
        $sql ="SELECT Oferta.Titulo, Oferta.Vacantes, Oferta.Fecha_Inicio, Oferta.Fecha_Fin, Usuario.Nombre_Usuario, Oferta.Descripcion, Oferta.Id_Oferta/*, Idioma.Idioma, Nivel.nivel, Titulacion.Nombre, Soft_Skill.nombre AS Nombre_soft, Hard_Skill.nombre AS Nombre_hard, Hard_Skill.tipo*/
        FROM Oferta, Usuario/*, Oferta_Nivel_Idioma, Nivel, Idioma, Oferta_Tipo_Titulacion, Titulacion, Oferta_Soft_Skill, Soft_Skill, Oferta_Hard_Skill, Hard_Skill*/
        WHERE Oferta.Activo = 1 AND Oferta.DNI_CIF = Usuario.DNI_CIF /*AND Oferta_Nivel_Idioma.Id_Oferta = Oferta.Id_Oferta AND Oferta_Nivel_Idioma.Id_Nivel = Nivel.Id_Nivel AND Oferta_Nivel_Idioma.Id_Idioma = Idioma.Id_Idioma AND Oferta_Tipo_Titulacion.Id_Oferta = Oferta.Id_Oferta AND Titulacion.Id_Tipo_Titulacion = Oferta_Tipo_Titulacion.Id_Tipo_Titulacion AND Oferta_Soft_Skill.Id_Oferta = Oferta.Id_Oferta AND Oferta_Soft_Skill.Id_Soft = Soft_Skill.Id_Soft AND Oferta_Hard_Skill.Id_Oferta = Oferta.Id_Oferta AND Oferta_Hard_Skill.Id_Hard = Hard_Skill.Id_Hard*/";
        
        $leeroferta = $conexion -> query($sql);
    
            while($fila = $leeroferta->fetch(PDO::FETCH_OBJ)){
                echo "<div class=\"container\">";
                echo "<p class=\"info\">Empresa: ".$fila ->Nombre_Usuario."</p>";
                echo "<hr class=\"divider\">";
                echo "<p class=\"info\">Puesto de trabajo: ".$fila ->Titulo."</p>";
                echo "<p class=\"info\">Vacantes: ".$fila ->Vacantes."</p>";
                echo "<p class=\"info\">Fecha inicio: ".$fila ->Fecha_Inicio."</p>";
                echo "<p class=\"info\">Descripcion: ".$fila ->Descripcion."</p>"; 

                ?>
                <button class="abrirModal">Ver Oferta</button>
                    <div class="ventanaModal modal">
                        <div class="modal-content">
                            <span class="cerrar">&times;</span>
                            <?php 
                                echo "<h2>Empresa: ".$fila->Nombre_Usuario."</h2>";
                                echo "<p>Puesto de trabajo: ".$fila->Titulo."</p>";
                                echo "<p>Vacantes: ".$fila->Vacantes."</p>";
                                echo "<p>Fecha inicio: ".$fila->Fecha_Inicio."</p>";
                                echo "<p>Descripcion: ".$fila->Descripcion."</p>"; 
                                echo "<p>Idioma: ".$fila->Idioma." - ".$fila->nivel."</p>";
                                echo "<p>Titulacion: ".$fila->Nombre."</p>";
                                echo "<p>Soft skills: ".$fila->Nombre_soft."</p>";
                                echo "<p>Hard skills: ".$fila->Nombre_hard."</p>";
                            ?>
                        </div>
                    </div>

                <form action="" method="POST">
                <input type="hidden" name="IdOferta" value="<?php echo $fila -> Id_Oferta?>">
                <input type="submit" name="inscribirse" value="Inscribirse">
                </form>
                <?php
                echo "</div>";
                ?>       

            <?php
            }
            if(isset($_POST['inscribirse'])){
                $IdOferta=$_POST['IdOferta'];
                $dni=$_SESSION['dni'];
                
                $sentencia = $conexion->prepare("INSERT INTO Alumno_Oferta (DNI_CIF, Id_Oferta)VALUES (?,?)");
                $sentencia->bindParam(1, $dni);
                $sentencia->bindParam(2, $IdOferta);

                try {
                    $sentencia->execute();
                    

                
                } catch (PDOException $e) {
                    //Poner una ventana modal si ya esta escrito.
                    echo '<script>';
                    echo 'Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Ya estas apuntado en la oferta."
                        })';
                    echo '</script>';
                } 
                
            }
    ?>
    </div>

    <script>
        var botonesAbrirModal = document.getElementsByClassName("abrirModal");

        for (var i = 0; i < botonesAbrirModal.length; i++) {
            botonesAbrirModal[i].addEventListener('click', function() {
                var modal = this.nextElementSibling;
                modal.style.display = "block";
                modal.getElementsByClassName("cerrar")[0].addEventListener('click', function() {
                    modal.style.display = "none";
                });
            });
        }
    </script>
</body>

</html>
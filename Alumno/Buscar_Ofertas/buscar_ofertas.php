<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "../../Funciones/conexion.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="../../Estilos/alumno.css">

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
        $sql="SELECT DISTINCT AreasDeNegocio.Nombre, AreasDeNegocio.ID FROM AreasDeNegocio, Empresa WHERE AreasDeNegocio.ID = Empresa.Area_Negocio";
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
        $sql="SELECT DISTINCT Idioma.Id_Idioma, Idioma.Idioma FROM Oferta_Nivel_Idioma, Idioma WHERE Oferta_Nivel_Idioma.Id_Idioma= Idioma.Id_Idioma";

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
            <input type="submit" name="buscar" value="Buscar">
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
    #nomostar {
        display: none;
    }
    </style>
    <?php
                $from = "";        
                $aa="";
                $sql ="SELECT DISTINCT Oferta.Titulo, Oferta.Vacantes, Oferta.Fecha_Inicio, Oferta.Fecha_Fin, Usuario.Nombre_Usuario, Oferta.Descripcion, Oferta.Id_Oferta
                FROM Oferta, Usuario, AreasDeNegocio, Empresa
                WHERE Oferta.Activo = 1 AND Oferta.DNI_CIF = Usuario.DNI_CIF AND AreasDeNegocio.ID=Empresa.Area_Negocio AND Empresa.DNI_CIF=Usuario.DNI_CIF";
            
            
            
            if($CIF_empresa!=""){
                $aa = $aa." AND Oferta.DNI_CIF='$CIF_empresa'";               
            }
            if($Area_negocio!=""){
                $aa = $aa." AND Empresa.Area_Negocio='$Area_negocio'";
            }
            if($Titulacion  !=""){
                $aa = $aa." AND Oferta_Tipo_Titulacion.Id_Oferta = Oferta.Id_Oferta AND Oferta_Tipo_Titulacion.Id_Tipo_Titulacion = Titulacion.Id_Tipo_Titulacion AND Titulacion.Id_Tipo_Titulacion='$Titulacion'";
                $from = $from.", Oferta_Tipo_Titulacion, Titulacion";
            }
            if($Idioma  !=""){
                $aa = $aa." AND Oferta_Nivel_Idioma.Id_Oferta = Oferta.Id_Oferta AND Oferta_Nivel_Idioma.Id_Idioma='$Idioma'";
                $from = $from.", Oferta_Nivel_Idioma";
            }
            
            $sql ="SELECT DISTINCT Oferta.Titulo, Oferta.Vacantes, Oferta.Fecha_Inicio, Oferta.Fecha_Fin, Usuario.Nombre_Usuario, Oferta.Descripcion, Oferta.Id_Oferta
            FROM Oferta, Usuario, AreasDeNegocio, Empresa$from
            WHERE Oferta.Activo = 1 AND Oferta.DNI_CIF = Usuario.DNI_CIF AND AreasDeNegocio.ID=Empresa.Area_Negocio AND Empresa.DNI_CIF=Usuario.DNI_CIF $aa";
        
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
                $nombreEmpresa = $fila ->Nombre_Usuario;
                echo "<hr class=\"divider\">";
                echo "<p class=\"info\">Puesto de trabajo: ".$fila ->Titulo."</p>";
                echo "<p class=\"info\">Vacantes: ".$fila ->Vacantes."</p>";
                echo "<p class=\"info\">Fecha inicio: ".$fila ->Fecha_Inicio."</p>";
                echo "<p class=\"info\">Descripcion: ".$fila ->Descripcion."</p>";
                $idOferta =  $fila -> Id_Oferta;
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
                                
                                $slqe="SELECT * FROM Oferta_Tipo_Titulacion, Titulacion WHERE Oferta_Tipo_Titulacion.Id_Tipo_Titulacion=Titulacion.Id_Tipo_Titulacion AND Oferta_Tipo_Titulacion.Id_Oferta = $idOferta;";
                                $statement = $conexion->prepare($slqe);
                                $statement->execute();
                                $numFilas = $statement->rowCount();                                
                                //echo $numFilas;
                                if($numFilas<1){
                                }
                                else{
                                $leer = $conexion -> query($slqe);
                                while($row = $leer->fetch(PDO::FETCH_OBJ)){
                                    if($row->Id_Oferta==$idOferta){
                                echo "<p>Titulacion: ".$row->Nombre."</p>";
                                }
                                }                               
                                }

                                $slqr="SELECT * FROM Oferta_Nivel_Idioma, Idioma, Nivel WHERE Oferta_Nivel_Idioma.Id_Idioma=Idioma.Id_Idioma AND Oferta_Nivel_Idioma.Id_Nivel = Nivel.Id_Nivel AND Oferta_Nivel_Idioma.Id_Oferta = $idOferta;";
                                $statement = $conexion->prepare($slqr);
                                $statement->execute();
                                $numFilas = $statement->rowCount();                                
                                //echo $numFilas;
                                if($numFilas<1){
                                }
                                else{
                                $leer = $conexion -> query($slqr);
                                while($row = $leer->fetch(PDO::FETCH_OBJ)){
                                    if($row->Id_Oferta==$idOferta){
                                echo "<p>Idioma: ".$row->Idioma." - ".$row->nivel."</p>";
                                }
                                }                               
                                }

                                $slqq="SELECT Oferta_Hard_Skill.Id_Oferta, Hard_Skill.nombre FROM Oferta_Hard_Skill, Hard_Skill WHERE Oferta_Hard_Skill.Id_Hard = Hard_Skill.Id_Hard AND Oferta_Hard_Skill.Id_Oferta= $idOferta;";
                                $statement = $conexion->prepare($slqq);
                                $statement->execute();
                                $numFilas = $statement->rowCount();                                
                                //echo $numFilas;
                                if($numFilas<1){
                                }
                                else{
                                $leer = $conexion -> query($slqq);
                                while($row = $leer->fetch(PDO::FETCH_OBJ)){
                                    if($row->Id_Oferta==$idOferta){
                                echo "<p>Soft Skill: ".$row->nombre."</p>";
                                }
                                }                               
                                }
                                $slqw="SELECT Oferta_Soft_Skill.Id_Oferta, Soft_Skill.nombre FROM Oferta_Soft_Skill, Soft_Skill WHERE Oferta_Soft_Skill.Id_Soft = Soft_Skill.Id_Soft AND Oferta_Soft_Skill.Id_Oferta= $idOferta;";
                                $statement = $conexion->prepare($slqw);
                                $statement->execute();
                                $numFilas = $statement->rowCount();                                
                                //echo $numFilas;
                                if($numFilas<1){
                                }
                                else{
                                $leer = $conexion -> query($slqw);
                                while($row = $leer->fetch(PDO::FETCH_OBJ)){
                                    if($row->Id_Oferta==$idOferta){
                                echo "<p>Hard Skill: ".$row->nombre."</p>";
                                }
                                }                               
                                }
                            ?>
        </div>
    </div>


    <form action="" method="post">
        <input type="hidden" name="IdOferta" value="<?php echo $idOferta?>">
        <input type="hidden" name="nombreEmpresa" value="<?php echo $nombreEmpresa?>">
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
        

        $sql ="SELECT Oferta.Titulo, Oferta.Vacantes, Oferta.Fecha_Inicio, Oferta.Fecha_Fin, Usuario.Nombre_Usuario, Oferta.Descripcion, Oferta.Id_Oferta
        FROM Oferta, Usuario
        WHERE Oferta.Activo = 1 AND Oferta.DNI_CIF = Usuario.DNI_CIF";

        

            $leeroferta = $conexion -> query($sql);
            while($fila = $leeroferta->fetch(PDO::FETCH_OBJ)){
                echo "<div class=\"container\">";
                echo "<p class=\"info\">Empresa: ".$fila ->Nombre_Usuario."</p>";
                $nombreEmpresa = $fila ->Nombre_Usuario;
                echo "<hr class=\"divider\">";
                echo "<p class=\"info\">Puesto de trabajo: ".$fila ->Titulo."</p>";
                echo "<p class=\"info\">Vacantes: ".$fila ->Vacantes."</p>";
                echo "<p class=\"info\">Fecha inicio: ".$fila ->Fecha_Inicio."</p>";
                echo "<p class=\"info\">Descripcion: ".$fila ->Descripcion."</p>";
                $idOferta =  $fila -> Id_Oferta;

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
                                
                                $slqe="SELECT * FROM Oferta_Tipo_Titulacion, Titulacion WHERE Oferta_Tipo_Titulacion.Id_Tipo_Titulacion=Titulacion.Id_Tipo_Titulacion AND Oferta_Tipo_Titulacion.Id_Oferta = $idOferta;";
                                $statement = $conexion->prepare($slqe);
                                $statement->execute();
                                $numFilas = $statement->rowCount();                                
                                //echo $numFilas;
                                if($numFilas<1){
                                }
                                else{
                                $leer = $conexion -> query($slqe);
                                while($row = $leer->fetch(PDO::FETCH_OBJ)){
                                    if($row->Id_Oferta==$idOferta){
                                echo "<p>Titulacion: ".$row->Nombre."</p>";
                                }
                                }                               
                                }

                                $slqr="SELECT * FROM Oferta_Nivel_Idioma, Idioma, Nivel WHERE Oferta_Nivel_Idioma.Id_Idioma=Idioma.Id_Idioma AND Oferta_Nivel_Idioma.Id_Nivel = Nivel.Id_Nivel AND Oferta_Nivel_Idioma.Id_Oferta = $idOferta;";
                                $statement = $conexion->prepare($slqr);
                                $statement->execute();
                                $numFilas = $statement->rowCount();                                
                                //echo $numFilas;
                                if($numFilas<1){
                                }
                                else{
                                $leer = $conexion -> query($slqr);
                                while($row = $leer->fetch(PDO::FETCH_OBJ)){
                                    if($row->Id_Oferta==$idOferta){
                                echo "<p>Idioma: ".$row->Idioma." - ".$row->nivel."</p>";
                                }
                                }                               
                                }

                                $slqq="SELECT Oferta_Hard_Skill.Id_Oferta, Hard_Skill.nombre FROM Oferta_Hard_Skill, Hard_Skill WHERE Oferta_Hard_Skill.Id_Hard = Hard_Skill.Id_Hard AND Oferta_Hard_Skill.Id_Oferta= $idOferta;";
                                $statement = $conexion->prepare($slqq);
                                $statement->execute();
                                $numFilas = $statement->rowCount();                                
                                //echo $numFilas;
                                if($numFilas<1){
                                }
                                else{
                                $leer = $conexion -> query($slqq);
                                while($row = $leer->fetch(PDO::FETCH_OBJ)){
                                    if($row->Id_Oferta==$idOferta){
                                echo "<p>Soft Skill: ".$row->nombre."</p>";
                                }
                                }                               
                                }
                                $slqw="SELECT Oferta_Soft_Skill.Id_Oferta, Soft_Skill.nombre FROM Oferta_Soft_Skill, Soft_Skill WHERE Oferta_Soft_Skill.Id_Soft = Soft_Skill.Id_Soft AND Oferta_Soft_Skill.Id_Oferta= $idOferta;";
                                $statement = $conexion->prepare($slqw);
                                $statement->execute();
                                $numFilas = $statement->rowCount();                                
                                //echo $numFilas;
                                if($numFilas<1){
                                }
                                else{
                                $leer = $conexion -> query($slqw);
                                while($row = $leer->fetch(PDO::FETCH_OBJ)){
                                    if($row->Id_Oferta==$idOferta){
                                echo "<p>Hard Skill: ".$row->nombre."</p>";
                                }
                                }                               
                                }
                            ?>
            </div>
        </div>

        <form action="" method="POST">
            <input type="hidden" name="IdOferta" value="<?php echo $idOferta?>">
            <input type="hidden" name="nombreEmpresa" value="<?php echo $nombreEmpresa?>">
            <input type="submit" name="inscribirse" value="Inscribirse">
        </form>
        <?php
                echo "</div>";
                ?>

        <?php
            }
            if(isset($_POST['inscribirse'])){
                $IdOferta=$_POST['IdOferta'];
                $nombreEmpresa=$_POST['nombreEmpresa'];
                $dni=$_SESSION['dni'];
                $sql_nombre_destino = "SELECT Nombre_Usuario FROM `Usuario` WHERE DNI_CIF='$dni'";
                $resultado_nombre_destino = $conexion->query($sql_nombre_destino);
                while ($row_nombre_destino = $resultado_nombre_destino->fetch(PDO::FETCH_OBJ)) {
                $Nombre_destino = $row_nombre_destino->Nombre_Usuario;
                }

                $sentencia = $conexion->prepare("INSERT INTO Alumno_Oferta (DNI_CIF, Id_Oferta)VALUES (?,?)");
                $sentencia->bindParam(1, $dni);
                $sentencia->bindParam(2, $IdOferta);

                //Manda una alerta a alumno de que se a inscrito
                $sentenciados = $conexion->prepare("INSERT INTO Alertas (Alerta, DNI_CIF, Vista) VALUES (?, ?, 1)");
                $Mensaje = "Te has inscrito a una oferta en ".$empresa;
                $sentenciados->bindParam(1, $Mensaje);
                $sentenciados->bindParam(2, $dni);
                
                //Manda una alerta a la empresa de que se a inscrito un alumno
                $sentenc = $conexion->prepare("INSERT INTO Alertas (Alerta, DNI_CIF, Vista) VALUES (?, ?, 1)");
                $nombreAlumno = $_SESSION['Nombre_Usuario'];
                $Mensaje2 = "Se ha inscrito el usuario ".$nombreAlumno;
                $sentenc->bindParam(1, $Mensaje2);
                $sentenc->bindParam(2, $Id_empresa);
            
               
                try {
                    $sentencia->execute();
                    $sentenciados->execute();
                    $sentenc->execute();
                    
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
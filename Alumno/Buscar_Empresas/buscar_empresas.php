<!DOCTYPE html>
<html lang="es">
<head>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "../../Funciones/conexion.php";
    ?>
    <link rel="stylesheet" href="../../Estilos/alumno.css">
</head>
<body>
<script>
    $(document).ready(function() {
      $(".show-more").click(function() {
        var descripcion = $(this).data('descripcion');
        $(this).prev(".info").html('<p class="description">' + descripcion + '</p>');
        $(this).hide();
      });
    });
</script>
    <div>
    <form action="" method="post">
        <p>Empresa</p>
        <?php 
        $sqlactivo = "SELECT Activo FROM Alumno WHERE DNI_CIF = '" . $_SESSION['dni'] . "'";

        if ($resultado = $conexion->query($sqlactivo)) {
            while ($row = $resultado->fetch(PDO::FETCH_OBJ)) {
                $Activo = $row->Activo;
            }
        } else {
            echo "Error en la consulta: " . $conexion->errorInfo()[2];
        }
        $sql="SELECT DISTINCT Usuario.Nombre_Usuario, Usuario.DNI_CIF FROM Usuario, Empresa, Oferta WHERE Tipo_Usuario='Empresa' AND Usuario.DNI_CIF = Empresa.DNI_CIF AND Oferta.DNI_CIF = Usuario.DNI_CIF AND Oferta.Activo=1";
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
        $sql="SELECT DISTINCT AreasDeNegocio.Nombre FROM AreasDeNegocio, Empresa WHERE AreasDeNegocio.ID = Empresa.Area_Negocio";

        if($resultado = $conexion -> query($sql)){
            ?>
            <select name="area_negocio" id="">
                <option value="">- Area de negocio -</option>

                <?php
            while($row = $resultado->fetch(PDO::FETCH_OBJ)){
                $Area_negocio= $row-> Nombre;
                ?>
                <option value="<?php echo $Area_negocio?>"><?php echo $Area_negocio?></option>
                <?php 

            }
            ?>
            </select>
            <?php 
        }
        ?>
        <input type="submit" name="Buscar" value="Buscar">
        <input type="reset" value="Limpiar">
    </form>
    </div>
    <?php

        if(isset($_POST['Buscar'])){
            $CIF_empresa=$_POST['empresa'];
            $Area_negocio=$_POST['area_negocio'];

            ?>
            <style>
        #nomostar{
            display: none;
        }
         </style>
         <?php
            
            $sql ="SELECT DISTINCT Empresa.DNI_CIF, Empresa.Numero_Trabajadores, Empresa.Web, Empresa.Telefono, Empresa.Descripcion, Empresa.Direccion, Usuario.Nombre_Usuario, Municipio.Nombre_Municipio, AreasDeNegocio.Nombre, paises.nombre
            FROM Empresa, Usuario, Municipio, AreasDeNegocio, paises, Oferta 
            WHERE Empresa.Activo=1 AND Empresa.DNI_CIF=Usuario.DNI_CIF AND Empresa.Id_Municipio=Municipio.Id_Municipio AND AreasDeNegocio.ID= Empresa.Area_Negocio AND paises.id = Empresa.Pais AND Usuario.DNI_CIF = Empresa.DNI_CIF AND Empresa.Activo AND Oferta.DNI_CIF = Usuario.DNI_CIF AND Oferta.Activo=1";
            
            if($CIF_empresa!=""){
                $sql = $sql." AND Empresa.DNI_CIF='$CIF_empresa'";               
            }
            if($Area_negocio!=""){
                $sql = $sql." AND AreasDeNegocio.Nombre='$Area_negocio'";
            }
            //echo $sql;
            if($CIF_empresa=="" && $Area_negocio==""){
                $sql ="SELECT DISTINCT Empresa.DNI_CIF, Empresa.Numero_Trabajadores, Empresa.Web, Empresa.Telefono, Empresa.Descripcion, Empresa.Direccion, Usuario.Nombre_Usuario, Municipio.Nombre_Municipio, AreasDeNegocio.Nombre, paises.nombre
                FROM Empresa, Usuario, Municipio, AreasDeNegocio, paises, Oferta 
                WHERE Empresa.Activo=1 AND Empresa.DNI_CIF=Usuario.DNI_CIF AND Empresa.Id_Municipio=Municipio.Id_Municipio AND AreasDeNegocio.ID= Empresa.Area_Negocio AND paises.id = Empresa.Pais AND Usuario.DNI_CIF = Empresa.DNI_CIF AND Empresa.Activo AND Oferta.DNI_CIF = Usuario.DNI_CIF AND Oferta.Activo=1";
            }
            $leeroferta = $conexion -> query($sql);
            while($fila = $leeroferta->fetch(PDO::FETCH_OBJ)){
                echo "<div class=\"container\" id='busca-empresa-alumno'>";
                echo "<div class=\"der-container\" id='busca-empresa-alumno-izq'>";
                $imagen = $fila ->DNI_CIF;
                $file_path = "../../Inicio/Inicio_Empresa/Datos_principales/FotosEmpresa/$imagen.png";

                if (file_exists($file_path)) {
                    echo "<img src='$file_path'>";
                } else {
                     echo "<img src='../../Inicio/Inicio_Empresa/Datos_principales/FotosEmpresa/default.png'>";
                }
                echo "</div>";
                echo "<div class=\"der-container\"  id='busca-empresa-alumno-der'>";

                echo "<p class=\"info\"><b>".$fila ->Nombre_Usuario."</b></p>";
                echo "<hr>";
                echo "<p class=\"info\"><b>Area de negocio: </b>".$fila ->Nombre."</p>";
                echo "<p class=\"info\"><b>Numero de trabajadores: </b>".$fila ->Numero_Trabajadores."</p>";
                $descripcion = $fila->Descripcion;
        $descripcion_corto = strlen($descripcion) > 30 ? substr($descripcion, 0, 30) . '...' : $descripcion;
        echo "<p class='info'><b>Descripción: </b> " . $descripcion_corto . "</p>";
        if (strlen($descripcion) > 30): 
            echo "<p class='show-more' data-descripcion='" . addslashes($descripcion) . "'>Leer más</p>";
        endif;
                echo "<p class=\"info\"><b>Pais: </b>".$fila ->nombre."</p>";
                echo "<p class=\"info\"><b>Localidad: </b>".$fila ->Nombre_Municipio."</p>";
                $webempresa=$fila ->Web;
                echo "<p class=\"info\"><b>Web: </b><a style='color: blue;' href=\"$webempresa\">".$webempresa."</a></p>";
                echo "<p class=\"info\"><b>Telefono: </b>".$fila ->Telefono."</p>";
                $idEmpresa = $fila ->DNI_CIF;      
                ?>
                <form action="../Mensajes/mensaje" method="post">
                    <input type="hidden" name="dni_usuario" id="dni_usuario" value="<?php echo $idEmpresa?>">
                    <?php if ($Activo==1){
                    echo" <input type='submit' name='mensaje' value='Mandar mensaje'>";
                    }else {
                        echo"<p class='mensaje-error'>Necesitas una cuenta verificada para poder Mandar un Mensaje</p>";
                    } ?>
                   
                </form>
    <?php
                    echo "</div>";

                echo "</div>";                
    ?>
    <?php
            }
        }
    ?>
<a href=""></a>


    <div id="nomostar">
    <?php
            $sql ="SELECT DISTINCT Empresa.DNI_CIF, Empresa.Numero_Trabajadores, Empresa.Web, Empresa.Telefono, Empresa.Descripcion, Empresa.Direccion, Usuario.Nombre_Usuario, Municipio.Nombre_Municipio, AreasDeNegocio.Nombre, paises.nombre
            FROM Empresa, Usuario, Municipio, AreasDeNegocio, paises, Oferta 
            WHERE Empresa.Activo=1 AND Empresa.DNI_CIF=Usuario.DNI_CIF AND Empresa.Id_Municipio=Municipio.Id_Municipio AND AreasDeNegocio.ID= Empresa.Area_Negocio AND paises.id = Empresa.Pais AND Usuario.DNI_CIF = Empresa.DNI_CIF AND Empresa.Activo AND Oferta.DNI_CIF = Usuario.DNI_CIF AND Oferta.Activo=1";        
            $leeroferta = $conexion -> query($sql);
            while($fila = $leeroferta->fetch(PDO::FETCH_OBJ)){
                echo "<div class=\"container\" id='busca-empresa-alumno'>";
                echo "<div class=\"der-container\" id='busca-empresa-alumno-izq'>";
                $imagen = $fila ->DNI_CIF;
                $file_path = "../../Inicio/Inicio_Empresa/Datos_principales/FotosEmpresa/$imagen.png";

                if (file_exists($file_path)) {
                    echo "<img src='$file_path'>";
                } else {
                     echo "<img src='../../Inicio/Inicio_Empresa/Datos_principales/FotosEmpresa/default.png'>";
                }
                echo "</div>";
                echo "<div class=\"der-container\"  id='busca-empresa-alumno-der'>";

                echo "<p class=\"info\"><b>".$fila ->Nombre_Usuario."</b></p>";
                echo "<hr>";
                echo "<p class=\"info\"><b>Area de negocio: </b>".$fila ->Nombre."</p>";
                echo "<p class=\"info\"><b>Numero de trabajadores: </b>".$fila ->Numero_Trabajadores."</p>";
                $descripcion = $fila->Descripcion;
        $descripcion_corto = strlen($descripcion) > 30 ? substr($descripcion, 0, 30) . '...' : $descripcion;
        echo "<p class='info'><b>Descripción: </b> " . $descripcion_corto . "</p>";
        if (strlen($descripcion) > 30): 
            echo "<p class='show-more' data-descripcion='" . addslashes($descripcion) . "'>Leer más</p>";
        endif;
                echo "<p class=\"info\"><b>Pais: </b>".$fila ->nombre."</p>";
                echo "<p class=\"info\"><b>Localidad: </b>".$fila ->Nombre_Municipio."</p>";
                $webempresa=$fila ->Web;
                echo "<p class=\"info\"><b>Web: </b><a target='_blank' style='color: blue;' href=\"$webempresa\">".$webempresa."</a></p>";
                echo "<p class=\"info\"><b>Telefono: </b>".$fila ->Telefono."</p>";
                $idEmpresa = $fila ->DNI_CIF;      
                ?>
                <form action="../Mensajes/mensaje" method="post">
                    <input type="hidden" name="dni_usuario" id="dni_usuario" value="<?php echo $idEmpresa?>">
                    <?php if ($Activo==1){
                    echo" <input type='submit' name='mensaje' value='Mandar mensaje'>";
                    }else {
                        echo"<p class='mensaje-error'>Necesitas una cuenta verificada para poder Mandar un Mensaje</p>";
                    } ?>
                   
                </form>
    <?php
                    echo "</div>";

                echo "</div>";                
    ?>
    <?php
            }
    ?>
    </div>
</body>
</html>
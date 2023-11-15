<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "../../Funciones/conexion.php";
    ?>
    <link rel="stylesheet" href="../../Estilos/buscar_empresas.css">
</head>
<body>
    <div>
    <form action="" method="post">
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
        $sql="SELECT DISTINCT Area_Negocio FROM Empresa";

        if($resultado = $conexion -> query($sql)){
            ?>
            <select name="area_negocio" id="">
                <option value="">- Area de negocio -</option>

                <?php
            while($row = $resultado->fetch(PDO::FETCH_OBJ)){
                $Area_negocio= $row-> Area_Negocio;
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
            
            $sql ="SELECT Empresa.Numero_Trabajadores, Empresa.Web, Empresa.Telefono, Empresa.Area_Negocio, Empresa.Descripcion, Empresa.Direccion, Empresa.Pais, Usuario.Nombre_Usuario, Municipio.Nombre_Municipio FROM Empresa, Usuario, Municipio WHERE Activo=1 AND Empresa.DNI_CIF=Usuario.DNI_CIF AND Empresa.Id_Municipio=Municipio.Id_Municipio";
            
            if($CIF_empresa!=""){
                $sql = $sql." AND Empresa.DNI_CIF='$CIF_empresa'";               
            }
            if($Area_negocio!=""){
                $sql = $sql." AND Empresa.Area_Negocio='$Area_negocio'";
            }
            //echo $sql;
            if($CIF_empresa=="" && $Area_negocio==""){
                $sql ="SELECT Empresa.Numero_Trabajadores, Empresa.Web, Empresa.Telefono, Empresa.Area_Negocio, Empresa.Descripcion, Empresa.Direccion, Empresa.Pais, Usuario.Nombre_Usuario, Municipio.Nombre_Municipio FROM Empresa, Usuario, Municipio WHERE Activo=1 AND Empresa.DNI_CIF=Usuario.DNI_CIF AND Empresa.Id_Municipio=Municipio.Id_Municipio";
            }

            $leeroferta = $conexion -> query($sql);
            while($fila = $leeroferta->fetch(PDO::FETCH_OBJ)){
                echo "<div class=\"container\">";
                echo "<p class=\"info\">Nombre: ".$fila ->Nombre_Usuario."</p>";
                echo "<hr>";
                echo "<p class=\"info\">Area de negocio: ".$fila ->Area_Negocio."</p>";
                echo "<p class=\"info\">Numero de trabajadores: ".$fila ->Numero_Trabajadores."</p>";
                echo "<p class=\"info\">Descripcion: ".$fila ->Descripcion."</p>";
                echo "<p class=\"info\">Pais: ".$fila ->Pais."</p>";
                echo "<p class=\"info\">Localidad: ".$fila ->Nombre_Municipio."</p>";
                echo "<p class=\"info\">Web: ".$fila ->Web."</p>";
                echo "<p class=\"info\">Telefono: ".$fila ->Telefono."</p>";
                echo "</div>";
                ?>
    <?php
            }
        }
    ?>



    <div id="nomostar">
    <?php
        $sql ="SELECT Empresa.DNI_CIF, Empresa.Numero_Trabajadores, Empresa.Web, Empresa.Telefono, Empresa.Area_Negocio, Empresa.Descripcion, Empresa.Direccion, Empresa.Pais, Usuario.Nombre_Usuario, Municipio.Nombre_Municipio FROM Empresa, Usuario, Municipio WHERE Activo=1 AND Empresa.DNI_CIF=Usuario.DNI_CIF AND Empresa.Id_Municipio=Municipio.Id_Municipio";
        
        $leeroferta = $conexion -> query($sql);
            while($fila = $leeroferta->fetch(PDO::FETCH_OBJ)){
                echo "<div class=\"container\">";
                echo "<p class=\"info\">Nombre: ".$fila ->Nombre_Usuario."</p>";
                echo "<hr>";
                echo "<p class=\"info\">Area de negocio: ".$fila ->Area_Negocio."</p>";
                echo "<p class=\"info\">Numero de trabajadores: ".$fila ->Numero_Trabajadores."</p>";
                echo "<p class=\"info\">Descripcion: ".$fila ->Descripcion."</p>";
                echo "<p class=\"info\">Pais: ".$fila ->Pais."</p>";
                echo "<p class=\"info\">Localidad: ".$fila ->Nombre_Municipio."</p>";
                echo "<p class=\"info\">Web: ".$fila ->Web."</p>";
                echo "<p class=\"info\">Telefono: ".$fila ->Telefono."</p>";
                $idEmpresa = $fila ->DNI_CIF;      
                ?>
                <form action="../Mensajes/mensaje.php" method="post">
                    <input type="hidden" name="idEmpresa" id="" value="<?php echo $idEmpresa?>">
                    <input type="submit" name="mensaje" value="Mandar mensaje">
                </form>
    <?php
                echo "</div>";
            }
    ?>
    </div>
</body>
</html>

    <!-- Incluir jQuery desde CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <!-- Mi script -->
    <script src="../../Funciones/select2.js"></script>

<?php

 include "../../Funciones/conexion.php";

 echo "<form action='index.php' method='POST'>";
 $sql="SELECT * FROM Titulacion";

 if($resultado = $conexion -> query($sql)){
     ?>
     <select name="titulacion"  class="titulacion">
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
    


<select name="idioma">
<?php 
$sql="SELECT * FROM Idioma";
if($resultado = $conexion -> query($sql)){
    ?>
        <option value="">- Idioma -</option>
        <?php
    while($row = $resultado->fetch(PDO::FETCH_OBJ)){
        $Idioma= $row-> Idioma;
        $Id_Idioma=$row-> Id_Idioma;
        ?>
        <option value="<?php echo $Id_Idioma?>"><?php echo $Idioma?></option>
        <?php 
    }
    ?>
    <?php 
}
?>
    </select>

<select name="movilidad" id="">
    <option value="">- Movilidad -</option>
    <option value="1">Si</option>
    <option value="0">No</option>
</select>
 <input type="submit" name="filtrar" value="Filtrar">
 </form>
<?php
if(isset($_POST['filtrar'])){
    $titulacion=$_POST['titulacion'];
    $idioma=$_POST['idioma'];
    $movilidad=$_POST['movilidad'];
    ?>
        <style>
            #nomostrar{
                display: none;
            }
        </style>
    <?php

    $from = "";
    $aa = "";

    if($titulacion!=""){
        $from = $from. ", Titulacion, Titulacion_Centro_Persona";
        $aa = $aa. "AND Titulacion_Centro_Persona.DNI_CIF = Alumno.DNI_CIF AND Titulacion_Centro_Persona.Id_Tipo_Titulacion='$titulacion' AND Titulacion_Centro_Persona.Id_Tipo_Titulacion = Titulacion.Id_Tipo_Titulacion";
    }
    if($idioma!=""){
        $from = $from. ", Nivel_Idioma, Idioma";
        $aa = $aa. " AND Nivel_Idioma.DNI_CIF = Usuario.DNI_CIF AND Nivel_Idioma.Id_Idioma = Idioma.Id_Idioma AND Idioma.Id_Idioma= $idioma";
    }
    if($movilidad!=""){
        $aa =  $aa." AND Alumno.Movilidad =  $movilidad";
    }

    $sql="SELECT Alumno.Apellido, Alumno.DNI_CIF, Alumno.Movilidad, Alumno.Coche
    FROM Usuario, Alumno  $from
    WHERE Perfil_Publico=1 AND Activo=1 AND Alumno.DNI_CIF = Usuario.DNI_CIF $aa";

if ($resultapellido = $conexion->query($sql)) {
    while ($rowapellido = $resultapellido->fetch(PDO::FETCH_OBJ)) {
        $Apellido = $rowapellido->Apellido;
        $dni = $rowapellido->DNI_CIF;
        $Movilidad = $rowapellido->Movilidad;
        $coche = $rowapellido->Coche;

        $querydni = "SELECT * FROM Usuario WHERE DNI_CIF='$dni'";
        if ($resultdni = $conexion->query($querydni)) {
        while ($rowdni = $resultdni->fetch(PDO::FETCH_OBJ)) {
        $Nombre_Usuario = $rowdni->Nombre_Usuario;


        echo "<div class=\"container\">";
        echo "<p class=\"info\"><b>Nombre:</b> ".$Nombre_Usuario."</p>";
        echo "<p class=\"info\"><b> Apellido:</b> ".$Apellido."</p>";
        if($Movilidad==1){
            echo "<p class=\"info\"><b> Movilidad:</b> Si</p>";
        }else{
            echo "<p class=\"info\"><b> Movilidad:</b> No</p>";
        }

        if($coche==1){
            echo "<p class=\"info\"><b> Coche:</b> Si</p>";
        }else{
            echo "<p class=\"info\"><b> Coche:</b> No</p>";
        }
        
        $querytitulo1 = "SELECT COUNT(*) as contar FROM Titulacion_Centro_Persona WHERE  DNI_CIF='$dni'";
        //echo $querytitulo1;
        if($resultitulo1 = $conexion->query($querytitulo1)){
            while ($rowtitulo1 = $resultitulo1->fetch(PDO::FETCH_OBJ)) {
                $contar = $rowtitulo1 -> contar;  
            }
            if($contar>0){
                echo "<p class=\"info\"><b>Titulacion:</b></p>";
            }
        }
        
        $queryid = "SELECT Id_Tipo_Titulacion FROM Titulacion_Centro_Persona WHERE  DNI_CIF='$dni'";
        if ($resultid = $conexion->query($queryid)) {
        while ($rowid = $resultid->fetch(PDO::FETCH_OBJ)) {
        $id_tipo = $rowid->Id_Tipo_Titulacion;

        $querytitulo = "SELECT Nombre FROM Titulacion WHERE Id_Tipo_Titulacion=$id_tipo";
            if ($resultitulo = $conexion->query($querytitulo)) {
                while ($rowtitulo = $resultitulo->fetch(PDO::FETCH_OBJ)) {
                $Nombre_titulo = $rowtitulo->Nombre;
                echo "<p class=\"info\"><b>-</b> ".$Nombre_titulo."</p>";
            }
            }
    }
}
            ?>  
            <div class="botonesOfertas"> 
                <button class="abrirModal">Ver Alumno</button>
                <div class="ventanaModal modal">
                    <div class="modal-cont">
                        <div class="drcha">
                        <span class="cerra drcha">&times;</span>
                        </div>
            <?php
            echo "<div class=\"izq\">";
            echo "<p class=\"info\"><b>Nombre:</b> ".$Nombre_Usuario."</p>";
            echo "<p class=\"info\"><b> Apellido:</b> ".$Apellido."</p>";
            if($Movilidad==1){
                echo "<p class=\"info\"><b> Movilidad:</b> Si</p>";
            }else{
                echo "<p class=\"info\"><b> Movilidad:</b> No</p>";
            }

            if($coche==1){
                echo "<p class=\"info\"><b> Coche:</b> Si</p>";
            }else{
                echo "<p class=\"info\"><b> Coche:</b> No</p>";
            }

            $querytitulo1 = "SELECT COUNT(*) as contar FROM Titulacion_Centro_Persona WHERE  DNI_CIF='$dni'";
            //echo $querytitulo1;
            if($resultitulo1 = $conexion->query($querytitulo1)){
                while ($rowtitulo1 = $resultitulo1->fetch(PDO::FETCH_OBJ)) {
                    $contar = $rowtitulo1 -> contar;  
                }
                if($contar>0){
                    echo "<p class=\"info\"><b>Titulacion:</b></p>";
                }
            }
        
            $queryid = "SELECT Id_Tipo_Titulacion FROM Titulacion_Centro_Persona WHERE  DNI_CIF='$dni'";
            if ($resultid = $conexion->query($queryid)) {
            while ($rowid = $resultid->fetch(PDO::FETCH_OBJ)) {
            $id_tipo = $rowid->Id_Tipo_Titulacion;

            $querytitulo = "SELECT Nombre FROM Titulacion WHERE Id_Tipo_Titulacion=$id_tipo";
                if ($resultitulo = $conexion->query($querytitulo)) {
                    while ($rowtitulo = $resultitulo->fetch(PDO::FETCH_OBJ)) {
                    $Nombre_titulo = $rowtitulo->Nombre;
                    echo "<p class=\"info\"><b>-</b> ".$Nombre_titulo."</p>";
                }
                }
        }
    }
    //FORMACION COMPLEMENTARIA


    $querytitulo5 = "SELECT COUNT(*) as cont FROM Formacion_Complementaria WHERE DNI_CIF='$dni'";
    //echo $querytitulo5;
    if($resultitulo5 = $conexion->query($querytitulo5)){
        while ($rowtitulo5 = $resultitulo5->fetch(PDO::FETCH_OBJ)) {
            $cont = $rowtitulo5 -> cont;  
        }
        if($cont>0){
            echo "<p class=\"info\"><b>Formacion Complementaria:</b></p>";
        }
    }
    $sqlw="SELECT * FROM Formacion_Complementaria WHERE Formacion_Complementaria.DNI_CIF='$dni'";
            //echo $sqlw;
                if($result=$conexion->query($sqlw)){
                while ($rowformacion = $result->fetch(PDO::FETCH_OBJ)) {
                    echo "<p class=\"info\"><b>- </b>".$rowformacion->Nombre."</p>";

                }
            }


            //EXPERIENCIA LABORAL


            $querytitulo6 = "SELECT COUNT(*) as cont FROM Experiencia_Laboral WHERE DNI_CIF='$dni'";
            //echo $querytitulo6;
            if($resultitulo6 = $conexion->query($querytitulo6)){
                while ($rowtitulo6 = $resultitulo6->fetch(PDO::FETCH_OBJ)) {
                    $cont = $rowtitulo6 -> cont;  
                }
                if($cont>0){
                    echo "<p class=\"info\"><b>Experiencia Laboral:</b></p>";
                }
            }


            $sqly="SELECT * FROM Experiencia_Laboral WHERE Experiencia_Laboral.DNI_CIF='$dni'";
            //echo $sqly;
                if($result=$conexion->query($sqly)){
                while ($rowexp = $result->fetch(PDO::FETCH_OBJ)) {
                    echo "<p class=\"info\"><b>- </b>".$rowexp->Nombre_Empresa." - ".$rowexp->Puesto."</p>";

                }
            }
        echo "</div>";
        echo "<div class=\"drcha\">";

            $querytitulo2 = "SELECT COUNT(*) as contar FROM Nivel_Idioma WHERE DNI_CIF='$dni'";
            //echo $querytitulo2;
            if($resultitulo2 = $conexion->query($querytitulo2)){
                while ($rowtitulo2 = $resultitulo2->fetch(PDO::FETCH_OBJ)) {
                    $contar = $rowtitulo2 -> contar;  
                }
                if($contar>0){
                    echo "<p class=\"info\"><b>Idioma:</b></p>";
                }
            }


            $sqla="SELECT Nivel_Idioma.Id_Idioma, Nivel_Idioma.id_Nivel, Idioma.Idioma, Nivel_Idioma.DNI_CIF, Nivel.nivel
            FROM Nivel_Idioma, Idioma, Nivel
            WHERE Nivel_Idioma.DNI_CIF='$dni' AND Nivel_Idioma.Id_Idioma = Idioma.Id_Idioma AND Nivel_Idioma.id_Nivel = Nivel.Id_Nivel";
            if($result=$conexion->query($sqla)){
            while ($rowidioma = $result->fetch(PDO::FETCH_OBJ)) {
                echo "<p class=\"info\"><b>- </b>".$rowidioma->Idioma ." - ". $rowidioma->nivel."</p>";

            }
}


            //HARD SKILLSSSSSSSSSSSSSSSSSSSSSSSS


            $querytitulo3 = "SELECT COUNT(*) as cont FROM Hard_Skill_Alumno WHERE DNI_CIF='$dni'";
            //echo $querytitulo3;
            if($resultitulo3 = $conexion->query($querytitulo3)){
                while ($rowtitulo3 = $resultitulo3->fetch(PDO::FETCH_OBJ)) {
                    $cont = $rowtitulo3 -> cont;  
                }
                if($cont>0){
                    echo "<p class=\"info\"><b>Hard Skill:</b></p>";
                }
            }


            $sqlf="SELECT * FROM Hard_Skill_Alumno, Hard_Skill WHERE Hard_Skill.Id_Hard=Hard_Skill_Alumno.Id_Hard AND Hard_Skill_Alumno.DNI_CIF='$dni'";
                if($result=$conexion->query($sqlf)){
                while ($rowhard = $result->fetch(PDO::FETCH_OBJ)) {
                    echo "<p class=\"info\"><b>- </b>".$rowhard->nombre."</p>";

                }
            }

            //SOFT SKILLSSSSSSSSSSSSSSSSSSSSSSSS


            $querytitulo4 = "SELECT COUNT(*) as cont FROM Soft_Skill_Alumno WHERE DNI_CIF='$dni'";
            //echo $querytitulo4;
            if($resultitulo4 = $conexion->query($querytitulo4)){
                while ($rowtitulo4 = $resultitulo4->fetch(PDO::FETCH_OBJ)) {
                    $cont = $rowtitulo4 -> cont;  
                }
                if($cont>0){
                    echo "<p class=\"info\"><b>Soft Skill:</b></p>";
                }
            }


            $sqlx="SELECT * FROM Soft_Skill_Alumno, Soft_Skill WHERE Soft_Skill.Id_Soft=Soft_Skill_Alumno.Id_Soft AND Soft_Skill_Alumno.DNI_CIF='$dni'";
            //echo $sqlx;
                if($result=$conexion->query($sqlx)){
                while ($rowsoft = $result->fetch(PDO::FETCH_OBJ)) {
                    echo "<p class=\"info\"><b>- </b>".$rowsoft->nombre."</p>";

                }
            }


            
            echo "</div>";

        ?>
        </div>
    </div>
        <form action="../Mensajes/mensaje.php" method="post">
            <input type="hidden" name="dni_usuario" value="<?php echo $dni?>" id="dni_usuario">
            <input type="submit" name="mensaje" value="Mandar mensaje">
        </form>
        </div>
        <?php
        echo "</div>";

    }
}
    }
}
    
    }
?>





<div id="nomostrar">
 <?php
$queryapellido = "SELECT Apellido, DNI_CIF, Movilidad, Coche FROM Alumno WHERE Perfil_Publico=1";
if ($resultapellido = $conexion->query($queryapellido)) {
    while ($rowapellido = $resultapellido->fetch(PDO::FETCH_OBJ)) {
        $Apellido = $rowapellido->Apellido;
        $dni = $rowapellido->DNI_CIF;
        $Movilidad = $rowapellido->Movilidad;
        $coche = $rowapellido->Coche;

        $querydni = "SELECT * FROM Usuario WHERE DNI_CIF='$dni'";
        if ($resultdni = $conexion->query($querydni)) {
        while ($rowdni = $resultdni->fetch(PDO::FETCH_OBJ)) {
        $Nombre_Usuario = $rowdni->Nombre_Usuario;
        echo "<div class=\"container\">";
        echo "<p class=\"info\"><b>Nombre:</b> ".$Nombre_Usuario."</p>";
        echo "<p class=\"info\"><b> Apellido:</b> ".$Apellido."</p>";
        if($Movilidad==1){
            echo "<p class=\"info\"><b> Movilidad:</b> Si</p>";
        }else{
            echo "<p class=\"info\"><b> Movilidad:</b> No</p>";
        }

        if($coche==1){
            echo "<p class=\"info\"><b> Coche:</b> Si</p>";
        }else{
            echo "<p class=\"info\"><b> Coche:</b> No</p>";
        }
        
        $querytitulo1 = "SELECT COUNT(*) as contar FROM Titulacion_Centro_Persona WHERE  DNI_CIF='$dni'";
        //echo $querytitulo1;
        if($resultitulo1 = $conexion->query($querytitulo1)){
            while ($rowtitulo1 = $resultitulo1->fetch(PDO::FETCH_OBJ)) {
                $contar = $rowtitulo1 -> contar;  
            }
            if($contar>0){
                echo "<p class=\"info\"><b>Titulacion:</b></p>";
            }
        }
        
        $queryid = "SELECT Id_Tipo_Titulacion FROM Titulacion_Centro_Persona WHERE  DNI_CIF='$dni'";
        if ($resultid = $conexion->query($queryid)) {
        while ($rowid = $resultid->fetch(PDO::FETCH_OBJ)) {
        $id_tipo = $rowid->Id_Tipo_Titulacion;

        $querytitulo = "SELECT Nombre FROM Titulacion WHERE Id_Tipo_Titulacion=$id_tipo";
            if ($resultitulo = $conexion->query($querytitulo)) {
                while ($rowtitulo = $resultitulo->fetch(PDO::FETCH_OBJ)) {
                $Nombre_titulo = $rowtitulo->Nombre;
                echo "<p class=\"info\"><b>-</b> ".$Nombre_titulo."</p>";
            }
            }
    }
}
            ?>
            <div class="botonesOfertas"> 
                <button class="abrirModal">Ver Alumno</button>
                <div class="ventanaModal modal">
                    <div class="modal-cont">
                        <div class="drcha">
                        <span class="cerra drcha">&times;</span>
                        </div>
            <?php
            echo "<div class=\"izq\">";
            echo "<p class=\"info\"><b>Nombre:</b> ".$Nombre_Usuario."</p>";
            echo "<p class=\"info\"><b> Apellido:</b> ".$Apellido."</p>";
            if($Movilidad==1){
                echo "<p class=\"info\"><b> Movilidad:</b> Si</p>";
            }else{
                echo "<p class=\"info\"><b> Movilidad:</b> No</p>";
            }

            if($coche==1){
                echo "<p class=\"info\"><b> Coche:</b> Si</p>";
            }else{
                echo "<p class=\"info\"><b> Coche:</b> No</p>";
            }

            $querytitulo1 = "SELECT COUNT(*) as contar FROM Titulacion_Centro_Persona WHERE  DNI_CIF='$dni'";
            //echo $querytitulo1;
            if($resultitulo1 = $conexion->query($querytitulo1)){
                while ($rowtitulo1 = $resultitulo1->fetch(PDO::FETCH_OBJ)) {
                    $contar = $rowtitulo1 -> contar;  
                }
                if($contar>0){
                    echo "<p class=\"info\"><b>Titulacion:</b></p>";
                }
            }
        
            $queryid = "SELECT Id_Tipo_Titulacion FROM Titulacion_Centro_Persona WHERE  DNI_CIF='$dni'";
            if ($resultid = $conexion->query($queryid)) {
            while ($rowid = $resultid->fetch(PDO::FETCH_OBJ)) {
            $id_tipo = $rowid->Id_Tipo_Titulacion;

            $querytitulo = "SELECT Nombre FROM Titulacion WHERE Id_Tipo_Titulacion=$id_tipo";
                if ($resultitulo = $conexion->query($querytitulo)) {
                    while ($rowtitulo = $resultitulo->fetch(PDO::FETCH_OBJ)) {
                    $Nombre_titulo = $rowtitulo->Nombre;
                    echo "<p class=\"info\"><b>-</b> ".$Nombre_titulo."</p>";
                }
                }
        }
    }
    //FORMACION COMPLEMENTARIA


    $querytitulo5 = "SELECT COUNT(*) as cont FROM Formacion_Complementaria WHERE DNI_CIF='$dni'";
    //echo $querytitulo5;
    if($resultitulo5 = $conexion->query($querytitulo5)){
        while ($rowtitulo5 = $resultitulo5->fetch(PDO::FETCH_OBJ)) {
            $cont = $rowtitulo5 -> cont;  
        }
        if($cont>0){
            echo "<p class=\"info\"><b>Formacion Complementaria:</b></p>";
        }
    }
    $sqlw="SELECT * FROM Formacion_Complementaria WHERE Formacion_Complementaria.DNI_CIF='$dni'";
            //echo $sqlw;
                if($result=$conexion->query($sqlw)){
                while ($rowformacion = $result->fetch(PDO::FETCH_OBJ)) {
                    echo "<p class=\"info\"><b>- </b>".$rowformacion->Nombre."</p>";

                }
            }


            //EXPERIENCIA LABORAL


            $querytitulo6 = "SELECT COUNT(*) as cont FROM Experiencia_Laboral WHERE DNI_CIF='$dni'";
            //echo $querytitulo6;
            if($resultitulo6 = $conexion->query($querytitulo6)){
                while ($rowtitulo6 = $resultitulo6->fetch(PDO::FETCH_OBJ)) {
                    $cont = $rowtitulo6 -> cont;  
                }
                if($cont>0){
                    echo "<p class=\"info\"><b>Experiencia Laboral:</b></p>";
                }
            }


            $sqly="SELECT * FROM Experiencia_Laboral WHERE Experiencia_Laboral.DNI_CIF='$dni'";
            //echo $sqly;
                if($result=$conexion->query($sqly)){
                while ($rowexp = $result->fetch(PDO::FETCH_OBJ)) {
                    echo "<p class=\"info\"><b>- </b>".$rowexp->Nombre_Empresa." - ".$rowexp->Puesto."</p>";

                }
            }
        echo "</div>";
        echo "<div class=\"drcha\">";

            $querytitulo2 = "SELECT COUNT(*) as contar FROM Nivel_Idioma WHERE DNI_CIF='$dni'";
            //echo $querytitulo2;
            if($resultitulo2 = $conexion->query($querytitulo2)){
                while ($rowtitulo2 = $resultitulo2->fetch(PDO::FETCH_OBJ)) {
                    $contar = $rowtitulo2 -> contar;  
                }
                if($contar>0){
                    echo "<p class=\"info\"><b>Idioma:</b></p>";
                }
            }


            $sqla="SELECT Nivel_Idioma.Id_Idioma, Nivel_Idioma.id_Nivel, Idioma.Idioma, Nivel_Idioma.DNI_CIF, Nivel.nivel
            FROM Nivel_Idioma, Idioma, Nivel
            WHERE Nivel_Idioma.DNI_CIF='$dni' AND Nivel_Idioma.Id_Idioma = Idioma.Id_Idioma AND Nivel_Idioma.id_Nivel = Nivel.Id_Nivel";
            if($result=$conexion->query($sqla)){
            while ($rowidioma = $result->fetch(PDO::FETCH_OBJ)) {
                echo "<p class=\"info\"><b>- </b>".$rowidioma->Idioma ." - ". $rowidioma->nivel."</p>";

            }
}


            //HARD SKILLSSSSSSSSSSSSSSSSSSSSSSSS


            $querytitulo3 = "SELECT COUNT(*) as cont FROM Hard_Skill_Alumno WHERE DNI_CIF='$dni'";
            //echo $querytitulo3;
            if($resultitulo3 = $conexion->query($querytitulo3)){
                while ($rowtitulo3 = $resultitulo3->fetch(PDO::FETCH_OBJ)) {
                    $cont = $rowtitulo3 -> cont;  
                }
                if($cont>0){
                    echo "<p class=\"info\"><b>Hard Skill:</b></p>";
                }
            }


            $sqlf="SELECT * FROM Hard_Skill_Alumno, Hard_Skill WHERE Hard_Skill.Id_Hard=Hard_Skill_Alumno.Id_Hard AND Hard_Skill_Alumno.DNI_CIF='$dni'";
                if($result=$conexion->query($sqlf)){
                while ($rowhard = $result->fetch(PDO::FETCH_OBJ)) {
                    echo "<p class=\"info\"><b>- </b>".$rowhard->nombre."</p>";

                }
            }

            //SOFT SKILLSSSSSSSSSSSSSSSSSSSSSSSS


            $querytitulo4 = "SELECT COUNT(*) as cont FROM Soft_Skill_Alumno WHERE DNI_CIF='$dni'";
            //echo $querytitulo4;
            if($resultitulo4 = $conexion->query($querytitulo4)){
                while ($rowtitulo4 = $resultitulo4->fetch(PDO::FETCH_OBJ)) {
                    $cont = $rowtitulo4 -> cont;  
                }
                if($cont>0){
                    echo "<p class=\"info\"><b>Soft Skill:</b></p>";
                }
            }


            $sqlx="SELECT * FROM Soft_Skill_Alumno, Soft_Skill WHERE Soft_Skill.Id_Soft=Soft_Skill_Alumno.Id_Soft AND Soft_Skill_Alumno.DNI_CIF='$dni'";
            //echo $sqlx;
                if($result=$conexion->query($sqlx)){
                while ($rowsoft = $result->fetch(PDO::FETCH_OBJ)) {
                    echo "<p class=\"info\"><b>- </b>".$rowsoft->nombre."</p>";

                }
            }


            
            echo "</div>";
            
          

        ?>
        </div>
        </div>
        <form action="../Mensajes/mensaje.php" method="post">
            <input type="hidden" name="dni_usuario" value="<?php echo $dni?>" id="dni_usuario">
            <input type="submit" name="mensaje" value="Mandar mensaje">
        </form>
        </div>
        <?php
        echo "</div>";
        

    }
}
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
            modal.getElementsByClassName("cerra")[0].addEventListener('click', function() {
                modal.style.display = "none";
            });
        });
    }

    </script>


<form action="exportar.php" method="post">
        <?php
    $sql="SELECT * FROM Titulacion";

    if($resultado = $conexion -> query($sql)){
    ?>
    <select name="titulacion" class="titulacion">
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
    <input type="submit" value="Exportar Excel">
    </form>


 <style>

        .moda {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        width: 80%;
        max-height: 80vh;
        overflow-y: auto; 
        transform: translate(-50%, -50%);
        padding: 10px;
        background-color: #fff;
        border: 1px solid #ccc;
        z-index: 1; 
        }
        /* .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 0;
        } */
        .moda-content{
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(3, 1fr);
            grid-column-gap: 0px;
            grid-row-gap: 0px; 
        }

        .datos-personales { 
            grid-area: 1 / 1 / 2 / 2;
            padding: 5px;
        }
        .titulacion { 
            grid-area: 2 / 1 / 3 / 2;
            padding: 5px;

        }
        .for-complementaria { 
            grid-area:  3 / 1 / 4 / 2; 
            padding: 5px;

        }
        .exp-laboral { 
            grid-area: 1 / 2 / 4 / 3; 
            padding: 5px;
            border-left: solid black 2px;
            border-right: solid black 2px;

        }
        .idioma { 
            grid-area:  1 / 3 / 2 / 4;
            padding: 5px;

        }
        .soft-skill { 
            grid-area: 2 / 3 / 3 / 4;
            padding: 5px;

        }
        .hard-skill { 
            grid-area: 3 / 3 / 4 / 4; 
            padding: 5px;

        }  
        .cerrar {
        cursor: pointer;
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
    }
    </style> 
<?php
include "../../Funciones/conexion.php";
$dni = $_SESSION['dni'];
$idoferta = $_POST['idoferta'];


$sql = "SELECT * FROM Alumno_Oferta, Usuario WHERE Alumno_Oferta.Id_Oferta = $idoferta AND Usuario.DNI_CIF = Alumno_Oferta.DNI_CIF";
if ($resultado = $conexion->query($sql)) {
    while ($fila = $resultado -> fetch(PDO::FETCH_OBJ)) {
        $nombre=$fila->Nombre_Usuario;
        $email=$fila->Email;
        $dni_alumno = $fila->DNI_CIF;
        echo "<hr>";
        echo "<div class=\"imagenVerCandidatos\">";
        $imagen = $fila ->DNI_CIF;
                $file_path = "../../Inicio/Inicio_Alumno/Datos_principales/FotosAlumnos/$dni_alumno.png";
                if (file_exists($file_path)) {
                    echo "<img width=10% src='$file_path'>";
                } else {
                    //echo "<img src='../../Inicio/Inicio_Empresa/Datos_principales/FotosEmpresa/default.png'>";
                    echo "error";
                }
            echo "<div class=\"nombreVerCandidatos\">";
        echo "<p>Nombre: ".$nombre."</p>";
        echo "<p>Email: ".$email."</p>";
            echo "</div>";
        echo "</div>";
        

        ?>
        <!-- <div class="botonesVerCandidatos">    -->
        <button class="abrirModal">Ver Perfil</button>

        <div class="moda">
            <div class="moda-content">
                <span class="cerrar">&times;</span>
        <div class="datos-personales">        
        <h3>Datos personales</h3>
        <?php
        echo "<hr>";
        echo "<p>".$nombre."</p>";
        echo "<p>".$email."</p>";
        
        
        $sqlcinco="SELECT * FROM Alumno WHERE DNI_CIF = '$dni_alumno'";
        if ($resultado5 = $conexion->query($sqlcinco)) {
            while ($fila5 = $resultado5 -> fetch(PDO::FETCH_OBJ)) {
                $movilidad = $fila5->Movilidad;
                if($movilidad==1){
                    echo "<p>Movilidad: Si</p>";
                }else{
                    echo "<p>Movilidad: No</p>"; 
                }

            }
        }
        ?>
        </div>
        <div class="exp-laboral">
        <h3>Experiencia laboral</h3>
        <?php
        $sqltres="SELECT * FROM Experiencia_Laboral WHERE Experiencia_Laboral.DNI_CIF='$dni_alumno'";
        if ($resultado3 = $conexion->query($sqltres)) {
            while ($fila3 = $resultado3 -> fetch(PDO::FETCH_OBJ)) {
                        echo "<hr>";    
                        echo "<p>Empresa: ".$fila3->Nombre_Empresa."</p>";
                        echo "<p>Puesto: ".$fila3->Puesto."</p>";
                        echo "<p>Descripcion: ".$fila3->Descripcion."</p>";
                        echo "<p>Fecha Inicio: ".$fila3->Fecha_Inicio."</p>";
                        echo "<p>Fecha Fin: ".$fila3->Fecha_Fin."</p>";

                    }
                }

                ?>
        </div>
        <div class="titulacion">
        <h3>Titulacion</h3>
        <?php
        $sqlocho="SELECT * FROM Titulacion_Centro_Persona, Titulacion WHERE Titulacion_Centro_Persona.DNI_CIF='$dni_alumno' AND Titulacion_Centro_Persona.Id_Tipo_Titulacion = Titulacion.Id_Tipo_Titulacion";
        if ($resultado8 = $conexion->query($sqlocho)) {
            while ($fila8 = $resultado8 -> fetch(PDO::FETCH_OBJ)) {
                        echo "<hr>";    
                        echo "<p>".$fila8->Nombre." - ".$fila8->Tipo."</p>";  
                    }
                }

                ?>
        </div>   
        <div class="for-complementaria">
                <h3>Formacion complementaria</h3>
                <?php        
        $sqldos="SELECT * FROM Formacion_Complementaria WHERE Formacion_Complementaria.DNI_CIF='$dni_alumno'";
        if ($resultado2 = $conexion->query($sqldos)) {
            while ($fila2 = $resultado2 -> fetch(PDO::FETCH_OBJ)) {
                        $formacion = $fila2->Nombre;
                        $entidad = $fila2-> Entidad_Emisora;
                        echo "<hr>";
                        echo "<p>Titulo: ".$fila2->Nombre."</p>";
                        echo "<p>Entidad Emisora: ".$fila2->Entidad_Emisora."</p>";

                    }
                }   
                ?>
        </div>
        <div class = "idioma">
                <h3>Idioma</h3>
                <hr>
                <?php        
        $sqlcuatro="SELECT Idioma.Idioma, Nivel.nivel
        FROM Nivel_Idioma, Idioma, Nivel
        WHERE Nivel_Idioma.DNI_CIF='$dni_alumno' AND Idioma.Id_Idioma = Nivel_Idioma.Id_Idioma AND Nivel.Id_Nivel = Nivel_Idioma.id_Nivel";
        if ($resultado4 = $conexion->query($sqlcuatro)) {
            while ($fila4 = $resultado4 -> fetch(PDO::FETCH_OBJ)) {
                        echo "<p>".$fila4->Idioma." - ".$fila4->nivel."</p>";
                    }
                }
                ?>
        </div>
        <div class="soft-skill">        
        <h3>Soft Skill</h3>
        <hr>
        <?php
        $sqlseis="SELECT Soft_Skill.nombre
        FROM Soft_Skill_Alumno, Soft_Skill
        WHERE Soft_Skill_Alumno.DNI_CIF='$dni_alumno' AND Soft_Skill.Id_Soft = Soft_Skill_Alumno.Id_Soft";
        if ($resultado6 = $conexion->query($sqlseis)) {
                while ($fila6 = $resultado6 -> fetch(PDO::FETCH_OBJ)) {
                            echo "<p>".$fila6->nombre."</p>";
                        }
                    }     
         ?>
        </div>
        <div class="hard-kill">
        <h3>Hard Skill</h3>
        <hr>
        <?php       
        $sqlsiete="SELECT Hard_Skill.nombre
        FROM Hard_Skill_Alumno, Hard_Skill
        WHERE Hard_Skill_Alumno.DNI_CIF='$dni_alumno' AND Hard_Skill.Id_Hard = Hard_Skill_Alumno.Id_Hard";
        if ($resultado7 = $conexion->query($sqlsiete)) {
            while ($fila7 = $resultado7 -> fetch(PDO::FETCH_OBJ)) {
                            echo "<p>".$fila7->nombre."</p>";
                        }
            }                                 
        
        ?>
        </div>
        </div>
        </div>
        <form action="../Solicitud_Entrevista/solicitud_entrevista.php" method="post">
                <input type="hidden" name="dniAlumno" value="<?php echo $dni_alumno ?>" id="">
                <input type="hidden" name="idOferta" value="<?php echo $idoferta ?>" id="">
                <input type="submit" value="Solicitar Entrevista">
        </form>
        <!-- </div> -->
        

        <?php
    }  
}
$sqll="SELECT COUNT(*) AS contar FROM Alumno_Oferta, Usuario WHERE Alumno_Oferta.Id_Oferta = $idoferta AND Usuario.DNI_CIF = Alumno_Oferta.DNI_CIF";
if ($resultado = $conexion->query($sqll)) {
    while ($fila = $resultado -> fetch(PDO::FETCH_OBJ)) {
        $contar=$fila->contar;
    }
}
//echo $contar;
if($contar==0){
    echo "<p>No hay alumno inscritos.</p>";
}
?>
<script>
    var botonesAbrirModal = document.getElementsByClassName("abrirModal");
    

    for (var i = 0; i < botonesAbrirModal.length; i++) {
        botonesAbrirModal[i].addEventListener('click', function() {
            var moda = this.nextElementSibling;
            moda.style.display = "block";
            moda.getElementsByClassName("cerrar")[0].addEventListener('click', function() {
                moda.style.display = "none";
            });
        });
    }

</script>

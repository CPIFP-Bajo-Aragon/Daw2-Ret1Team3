
<?php 
    include "../../Funciones/conexion.php";
    $dni = $_SESSION['dni'];
    $username = $_SESSION['Nombre_Usuario'];
    ?>
                  <!DOCTYPE html>
                   <html lang="en">
                   <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                    <link rel="stylesheet" href="../../Estilos/curriculum.css">
                    <style>
    body {
    font-family: 'Arial', sans-serif;
    margin: 20px;
}

h1.title {
    font-size: 1.5em;
    margin-bottom: 10px;
}

.div1, .div2, .div3, .div4, .div5, .div6, .div7 {
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 15px;
    width: auto;
}

.imagen {
    max-width: 100px;
    max-height: 100px;
    border-radius: 10%;
    margin-right: 15px;
}
.div1{
    display: flex;
  justify-content: center;}

.texto, .div2, .div3, .div4, .div5, .div6, .div7 {
    display: inline-block;
    vertical-align: top;
    width: 100%;
}

p {
    margin: 5px 0;
}

optgroup {
    font-weight: bold;
}
.vitae {
    display: flex;
    flex-direction: row;
    align-items: center;
    text-align: center;
}




@media print {
    .div2, .div3, .div4, .div5, .div6, .div7 {
        width: 100%;
    }
}

    </style>
                   </head>
                   <body>
                   <?php


$queryalumno = "SELECT * FROM Alumno WHERE DNI_CIF='$dni'";

if ($resultalumno = $conexion->query($queryalumno)) {
    while ($rowalumno = $resultalumno->fetch(PDO::FETCH_OBJ)) {
         $Apellido = $rowalumno->Apellido;
         $Fecha_Nacimiento = $rowalumno->Fecha_Nacimiento;
         $Telefono_Alumno = $rowalumno->Telefono_Alumno;
         $Movilidad = $rowalumno->Movilidad;
         $Direccion = $rowalumno->Direccion;
         $Perfil_Publico = $rowalumno->Perfil_Publico;
         $id_Municipio_usuario = $rowalumno->Id_Municipio;
         $coche=$rowalumno->Coche;

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


$queryemail = "SELECT Email FROM Usuario WHERE DNI_CIF='$dni'";
if ($resultemail = $conexion->query($queryemail)) {
    while ($rowemail = $resultemail->fetch(PDO::FETCH_OBJ)) {
        $email = $rowemail->Email;
    }

}

if ($Movilidad == 1) {
    $Movilidad = "Yes";
} else {
    $Movilidad = "No";
}
if ($coche == 1) {
    $coche = "Yes";
} else {
    $coche = "No";
}

    echo "
    <div class=\"vitae\">
    <h1> CURRICULUM VITAE - </H1>
    <img src=\"../../Imagenes/logo_europass.png\" width=\"240px\" height=\"160px\" alt=\"imagen-europass\">
    </div>
    <h1 class='title' id='titulo'>Personal data</h1>";
?>

<div class="div1">
    <?php

    echo "<img class='imagen' src='../../Inicio/Inicio_Alumno/Datos_principales/FotosAlumnos/$dni.png' alt='Imagen icono'>";
    echo "<div class='texto'>";
    echo "<p>Name: " . $Nombre_Usuario . "</p>";
    echo "<p>Surname: " . $Apellido . "</p>";
    echo "<p>Date of birth: " . $Fecha_Nacimiento . "</p>";
    echo "<p>Address: " . $Direccion . "</p>";
    echo "<p>City: " . $Nombre_Municipio . "</p>";
    echo "<p>Mobility: " . $Movilidad . "</p>";
    echo "<p>Have Car : " . $coche . "</p>";
    echo "</div>";
    ?>
</div>
<?php
echo "<h1 class='title'>Contact</h1>";
?>
<div class="div2">
    <?php
    echo "<p>Phone: " . $Telefono_Alumno . "</p>";
    echo "<p>Email: " . $email . "</p>";

    ?>
</div>
<?php

echo "<h1 class='title'>Work Experience</h1>";
$queryexplab = "SELECT * FROM Experiencia_Laboral WHERE DNI_CIF='$dni'";
if ($resultexplab = $conexion->query($queryexplab)) {
    while ($rowexplab = $resultexplab->fetch(PDO::FETCH_OBJ)) {
        $id = $rowexplab->Id_Experiencia_Laboral;
        $Nombre_Empresa = $rowexplab->Nombre_Empresa;
        $Puesto = $rowexplab->Puesto;
        $Descripcion = $rowexplab->Descripcion;
        $Fecha_Inicio_explab = $rowexplab->Fecha_Inicio;
        $Fecha_Fin_explab = $rowexplab->Fecha_Fin;



        ?>
<div class="div3">
    <?php

            echo "<p>Company name: " . $Nombre_Empresa . "</p>";
            echo "<p>Workplace: " . $Puesto . "</p>";
            echo "<p>Description: " . $Descripcion . "</p>";
            echo "<p>Start date: " . $Fecha_Inicio_explab . "</p>";
            echo "<p>End date: " . $Fecha_Fin_explab . "</p>";
            ?>
</div>
<?php
    }
}

$querytitulo = "SELECT Centro.Nombre_Centro, Centro.Id_Centro, Titulacion_Centro_Persona.Fecha_Inicio, Titulacion_Centro_Persona.Fecha_Fin, Titulacion.Nombre, Titulacion.Id_Tipo_Titulacion FROM Centro, Alumno, Titulacion, Titulacion_Centro_Persona WHERE Centro.Id_Centro = Titulacion_Centro_Persona.Id_Centro AND Alumno.DNI_CIF = Titulacion_Centro_Persona.DNI_CIF AND Titulacion.Id_Tipo_Titulacion = Titulacion_Centro_Persona.Id_Tipo_Titulacion AND Alumno.DNI_CIF = :dni";

$stmttitulo = $conexion->prepare($querytitulo);
$stmttitulo->bindParam(':dni', $dni);
$stmttitulo->execute();

echo "<h1 class='title'>Qualifications</h1>";
while ($rowtitulo = $stmttitulo->fetch(PDO::FETCH_ASSOC)) {
    $Id_Centro = $rowtitulo['Id_Centro'];
    $Id_Tipo_Titulacion = $rowtitulo['Id_Tipo_Titulacion'];
    $Fecha_Inicio = $rowtitulo['Fecha_Inicio'];

    $Nombre_Centro = $rowtitulo['Nombre_Centro'];
    $Fecha_Inicio_titulo = $rowtitulo['Fecha_Inicio'];
    $Fecha_Fin_titulo = $rowtitulo['Fecha_Fin'];
    $nombre_titulo = $rowtitulo['Nombre'];

    ?>
<div class="div7">
    <?php

        echo "<p>Name of the centre: " . $Nombre_Centro . "</p>";
        echo "<p>Qualifications: " . $nombre_titulo . "</p>";
        echo "<p>Start date: " . $Fecha_Inicio_titulo . "</p>";
        echo "<p>End date: " . $Fecha_Fin_titulo . "</p>";
        ?>
</div>
<?php

}


echo "<h1 class='title'>Complementary training</h1>";
$queryformacion = "SELECT * FROM Formacion_Complementaria  WHERE DNI_CIF='$dni'" ;
if ($resultformacion = $conexion->query($queryformacion)) {
    while ($rowformacion = $resultformacion->fetch(PDO::FETCH_OBJ)) {
        $Id_Formacion = $rowformacion->Id_Formacion_Complementaria;
        $Nombre_Formacion = $rowformacion->Nombre;
        $Entidad_emisora = $rowformacion->Entidad_Emisora;
        $Fecha_Inicio_formacion = $rowformacion->Fecha_Inicio;
        $Fecha_Fin_formacion = $rowformacion->Fecha_Fin;
        $Fecha_Caducidad_formacion = $rowformacion->Fecha_Caducidad;
        $Num_Horas_formacion = $rowformacion->Num_Horas;


        ?>
<div class="div5">
    <?php
            echo "<p>Complementary training: " . $Nombre_Formacion . "</p>";
            echo "<p>Issuing Entity: " . $Entidad_emisora . "</p>";
            echo "<p>Start date: " . $Fecha_Inicio_formacion . "</p>";
            echo "<p>End date: " . $Fecha_Fin_formacion . "</p>";
            echo "<p>Expiry date: " . $Fecha_Caducidad_formacion . "</p>";
            echo "<p>Number of hours: " . $Num_Horas_formacion . "</p>";

            ?>
</div>

<?php
    }
}


$queryidioma = "SELECT Idioma.Idioma, Nivel.Nivel, Idioma.Id_Idioma
FROM Idioma
JOIN Nivel_Idioma ON Idioma.Id_Idioma = Nivel_Idioma.Id_Idioma
JOIN Nivel ON Nivel.Id_Nivel = Nivel_Idioma.Id_Nivel
WHERE Nivel_Idioma.DNI_CIF = '$dni'";


echo "<h1 class='title'>Language</h1>";
if ($resultidioma = $conexion->query($queryidioma)) {
    while ($rowidioma = $resultidioma->fetch(PDO::FETCH_OBJ)) {
        $Idioma = $rowidioma->Idioma;
        $Nivel = $rowidioma->Nivel;
        $Id_Idioma = $rowidioma->Id_Idioma;

        ?>
<div class="div4">
    <?php
            echo "<p>Language: " . $Idioma . "</p>";
            echo "<p>Type: " . $Nivel . "</p>";
            ?>
</div>
<?php
    }

}
$queryhard = "SELECT Hard_Skill.Id_Hard, Hard_Skill.nombre, Hard_Skill.tipo FROM Hard_Skill, Hard_Skill_Alumno WHERE Hard_Skill.Id_Hard=Hard_Skill_Alumno.Id_Hard AND DNI_CIF='$dni'; ";

echo "<h1 class='title'>Hard Skills</h1>";
$prevTipo = null;

if ($resulthard = $conexion->query($queryhard)) {
    while ($rowhard = $resulthard->fetch(PDO::FETCH_OBJ)) {
        $Id_Hard = $rowhard->Id_Hard;
        $nombre_hard = $rowhard->nombre;
        $tipo_hard = $rowhard->tipo;
        ?>
        <div class="div5">
            <?php
      
            echo "<P>$nombre_hard</P>";
            ?>
            </div>
                <?php
        }


}


$querysoft = "SELECT Soft_Skill.Id_Soft, Soft_Skill.nombre FROM Soft_Skill, Soft_Skill_Alumno WHERE Soft_Skill.Id_Soft=Soft_Skill_Alumno.Id_Soft AND DNI_CIF='$dni'; ";

echo "<h1 class='title'>Soft Skills</h1>";
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

?>






 
                   </body>
                   </html>
                
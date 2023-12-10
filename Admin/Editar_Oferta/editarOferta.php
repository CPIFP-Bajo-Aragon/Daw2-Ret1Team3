<?php

include "../../Funciones/conexion.php";

 


$username = $_SESSION['Nombre_Usuario'];

if (!isset($_SESSION['dni'])) {
    header("Location: ../../index");
    exit();
}

$sql = $conexion->prepare("SELECT MAX(Id_Oferta) AS UltimoId FROM Oferta WHERE DNI_CIF = ?");
$sql->bindParam(1, $dniEmpresa);

if ($sql->execute()) {
    if ($row = $sql->fetch(PDO::FETCH_OBJ)) {
        $UltimoId = $row->UltimoId;
        $_SESSION['ultimoID']=$UltimoId;
        $Id_Oferta = $_SESSION['ultimoID'];
    }
} else {
    echo "Error en la ejecución de la consulta: " . $sql->errorInfo()[2];
}

if (is_null($Id_Oferta = $_GET['Id_Oferta'])) {
    $Id_Oferta = $_POST['Id_Oferta'];
} else{
    $Id_Oferta = $_GET['Id_Oferta'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../Estilos/editaroferta.css">
    <link rel="stylesheet" href="../../Estilos/alumno.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    <?php include "../../Header/CabeceraLogeado.php"; ?>
    <div class="main-content">
        <?php include "../../menuLateral/Admin/menuAdmin.php"; ?>

        <section class="main-info">
            <div class="breadcrumbs">
                <h1 id="breadcrumbs-title">Admin / <span>Editar oferta</span></h1>
                <div class="breadcrumb-dropdown enlace-caja">
                    <ul>
                        <li></li>
                        <li><a href="#datosPrincipales">Datos principales</a></li>
                        <li><a href="#titulaciones">Titulaciones</a></li>
                        <li><a href="#formacionComplementaria">Formación complementaria</a></li>
                        <li><a href="#experiencia">Experiencia</a></li>
                        <li><a href="#habilidadesPersonales">Habilidades personales</a></li>
                        <li><a href="#habilidadesBasicas">Habilidades básicas</a></li>
                        <li><a href="#idiomas">Idiomas</a></li>
                    </ul>
                </div>
            </div>

            <article class="card">
                <?php
      
                echo "Id_Oferta: " . $Id_Oferta . "<br>";
             


                // Sección 1: Hard Skills
$query = "SELECT Hard_Skill.* FROM Hard_Skill";
if ($resultado = $conexion->query($query)) {
    echo '<form action="Hard.php" method="post">';
    echo '<label for="hard_skill">Selecciona Hard Skill:</label>';
    echo '<select name="Id_Hard" id="hard_skill">';
    while ($rowResultado = $resultado->fetch(PDO::FETCH_OBJ)) {
        $Nombre_Hard_Skill = $rowResultado->nombre;
        $Id_Hard = $rowResultado->Id_Hard;
        echo "<option value='$Id_Hard'>$Nombre_Hard_Skill</option>";
    }
    echo '</select>';
    echo "<input type='hidden' name='Id_Oferta' value='$Id_Oferta'></input>";
    echo '<input type="submit" value="Añadir">';
    echo '</form>';

}

// Sección 1: Hard Skills ya añadidas
$query = "SELECT Hard_Skill.* FROM Hard_Skill, Oferta_Hard_Skill WHERE Hard_Skill.Id_Hard = Oferta_Hard_Skill.Id_Hard and Oferta_Hard_Skill.Id_Oferta = $Id_Oferta";


if ($resultado = $conexion->query($query)) {
    while ($rowResultado = $resultado->fetch(PDO::FETCH_OBJ)) {
        $Nombre_Hard_Skill = $rowResultado->nombre;
        $Id_Hard = $rowResultado->Id_Hard;
        echo "<div class='divAnadido'>";
        echo '<form action="borrarOferta.php" method="POST">';
        echo "<input type='hidden' name='Id_Oferta' value='$Id_Oferta'></input>";
        echo "<input type='hidden' name='Id_Hard' value='$Id_Hard'></input>";
        echo "<input type='text' class='ya-anadido' value='$Nombre_Hard_Skill' disabled='disabled'></input>";
        echo '<input type="submit" name="borrarHardSkill" value="Borrar">';
        echo '</form>';
        echo "</div>";
    }



}
?>

            </article>
            <article class="card">
                <?php
// Sección 2: Idiomas y Niveles
$query = "SELECT Nivel.*, Idioma.* FROM Nivel, Idioma";
if ($resultado = $conexion->query($query)) {
    echo '<form action="Idioma.php" method="post">';
     echo '<label for="Idioma">Selecciona un idioma:</label>';
    $sql = "SELECT * FROM Idioma";
    if ($resultado = $conexion->query($sql)) {
        echo '<select name="Idioma" id="">';
        echo '<option value="">- Idioma -</option>';
        while ($row = $resultado->fetch(PDO::FETCH_OBJ)) {
            $Idioma = $row->Idioma;
            $Id_Idioma = $row->Id_Idioma;
            echo '<option value="' . $Id_Idioma . '">' . $Idioma . '</option>';
        }
        echo '</select>';
    }
    
    
    
    $sql = "SELECT * FROM Nivel";
    if ($resultado = $conexion->query($sql)) {
        echo '<select name="Nivel" id="">';
        echo '<option value="">- Nivel -</option>';
        while ($row = $resultado->fetch(PDO::FETCH_OBJ)) {
            $Nivel = $row->nivel;
            $Id_Nivel = $row->Id_Nivel;
            echo '<option value="' . $Id_Nivel . '">' . $Nivel . '</option>';
        }
        echo '</select>';
    }
    
    
    echo "<input type='hidden' name='Id_Oferta' value='$Id_Oferta'></input>";
    echo '<input type="submit" value="Añadir">';
    echo '</form>';
}


// Sección 2: Idiomas y Niveles ya añadidos
$query = "SELECT Idioma.Idioma, Idioma.Id_Idioma, Nivel.nivel, Nivel.Id_Nivel FROM Oferta_Nivel_Idioma, Idioma, Nivel, Oferta WHERE Idioma.Id_Idioma = Oferta_Nivel_Idioma.Id_Idioma AND Nivel.Id_Nivel = Oferta_Nivel_Idioma.Id_Nivel AND Oferta_Nivel_Idioma.Id_Oferta = Oferta.Id_Oferta AND Oferta.Id_Oferta = $Id_Oferta";
if ($resultado = $conexion->query($query)) {

    while ($rowResultado = $resultado->fetch(PDO::FETCH_OBJ)) {
        $Idioma = $rowResultado->Idioma;
        $Id_Idioma = $rowResultado->Id_Idioma;
        $nivel = $rowResultado->nivel;
        $Id_Nivel = $rowResultado->Id_Nivel;    
        echo "<div class='divAnadido'>";
        echo '<form action="borrarOferta.php" method="post">';
        echo "<input type='hidden' name='Id_Oferta' value='$Id_Oferta'></input>";
        echo "<input type='hidden' name='Id_Nivel' value='$Id_Nivel'></input>";
        echo "<input type='hidden' name='Id_Idioma' value='$Id_Idioma'></input>";
        echo "<input type='text' class='ya-anadido' value='$Idioma' disabled='disabled'></input>";
        echo "<input type='text' class='ya-anadido' value='$nivel' disabled='disabled'></input>";
        echo '<input type="submit" name="borrarIdioma" value="Borrar"><br>';
        echo '</form>';
        echo '</div>';
    }


}
?>
            </article>
            <article class="card">
                <?php
// Sección 3: Soft Skills
$query = "SELECT Soft_Skill.* FROM Soft_Skill";
if ($resultado = $conexion->query($query)) {
    echo '<form action="Soft.php" method="post">';
    echo '<label for="soft_skill">Selecciona Soft Skill:</label>';
    echo '<select name="Id_Soft" id="soft_skill">';
    while ($rowResultado = $resultado->fetch(PDO::FETCH_OBJ)) {
        $Id_Soft = $rowResultado->Id_Soft;
        $nombre_soft_skill = $rowResultado->nombre;
       
        echo "<option value='$Id_Soft'>$nombre_soft_skill</option>";
    }
    echo '</select>';
    echo "<input type='hidden' name='Id_Oferta' value='$Id_Oferta'></input>";
    echo '<input type="submit" value="Añadir">';
    echo '</form>';
}

// Sección 3: Soft Skills ya añadidos
$query = "SELECT Soft_Skill.* FROM Oferta_Soft_Skill, Soft_Skill WHERE Oferta_Soft_Skill.Id_Soft = Soft_Skill.Id_Soft AND Id_Oferta = $Id_Oferta";
if ($resultado = $conexion->query($query)) {

    while ($rowResultado = $resultado->fetch(PDO::FETCH_OBJ)) {
        $Id_Soft = $rowResultado->Id_Soft;
        $nombre_soft_skill = $rowResultado->nombre;
        echo "<div class='divAnadido'>";
        echo '<form action="borrarOferta.php" method="post">';
        echo "<input type='hidden' name='Id_Oferta' value='$Id_Oferta'></input>";
        echo "<input type='hidden' name='Id_Soft' value='$Id_Soft'></input>";
        echo "<input type='text' class='ya-anadido' value='$nombre_soft_skill' disabled='disabled'></input>";
        echo '<input type="submit" name="borrarSoftSkill" value="Borrar"><br>';
        echo '</form>';
        echo "</div>";
    }

}

?>
            </article>
            <article class="card">
                <?php

// Sección 4: Titulaciones
$query = "SELECT Titulacion.* FROM Titulacion";
if ($resultado = $conexion->query($query)) {
    echo '<form action="Titulacion.php" method="post">';
    echo '<label for="titulacion">Selecciona Titulación:</label>';
    echo '<select name="Id_Titulacion" id="titulacion">';
    while ($rowResultado = $resultado->fetch(PDO::FETCH_OBJ)) {
        $nombreTitulacion = $rowResultado->Nombre;
        $Id_Tipo_Titulacion = $rowResultado->Id_Tipo_Titulacion;
        echo "<option value='$Id_Tipo_Titulacion'>$nombreTitulacion</option>";
    }
    echo '</select>';
    echo "<input type='hidden' name='Id_Oferta' value='$Id_Oferta'></input>";
    echo '<input type="submit" value="Añadir">';
    echo '</form>';
}

// Sección 4: Titulaciones ya añadidos
$query = "SELECT Titulacion.Nombre, Titulacion.Id_Tipo_Titulacion FROM Oferta_Tipo_Titulacion, Titulacion WHERE Titulacion.Id_Tipo_Titulacion = Oferta_Tipo_Titulacion.Id_Tipo_Titulacion AND Id_Oferta = $Id_Oferta";
if ($resultado = $conexion->query($query)) {

    while ($rowResultado = $resultado->fetch(PDO::FETCH_OBJ)) {
        $nombreTitulacion = $rowResultado->Nombre;
        $Id_Tipo_Titulacion = $rowResultado->Id_Tipo_Titulacion;
        echo "<div class='divAnadido'>";
        echo '<form action="borrarOferta.php" method="post">';
        echo "<input type='hidden' name='Id_Oferta' value='$Id_Oferta'></input>";
        echo "<input type='text' class='ya-anadido' value='$nombreTitulacion' disabled='disabled'></input>";
        echo "<input type='hidden' name='Id_Tipo_Titulacion' value='$Id_Tipo_Titulacion'></input>";
        echo '<input type="submit" name="borrarTitulacion" value="Borrar"><br>';
        echo '</form>';
        echo "</div>";
    }

}

?>
            </article>
            <article class="card">
                <?php

                // Sección 5: Fecha actual
                $query = "SELECT Oferta.Id_Oferta, Oferta.Fecha_Fin, Oferta.Fecha_Inicio FROM Oferta WHERE Id_Oferta = $Id_Oferta";
                if ($resultado = $conexion->query($query)) {
                    while ($rowResultado = $resultado->fetch(PDO::FETCH_OBJ)) {
                        $Id_Oferta = $rowResultado->Id_Oferta;
                        $Fecha_Inicio = $rowResultado->Fecha_Inicio;
                        $Fecha_Fin = $rowResultado->Fecha_Fin;
                    }

                    // Mostrar mensajes de error aquí
                    if (isset($_SESSION['error_message'])) {
                        echo '<div style="color: red; margin-bottom: 10px;">' . $_SESSION['error_message'] . '</div>';
                        unset($_SESSION['error_message']); // Limpiar la sesión después de mostrar el mensaje
                    }
                   
                     echo "<h4>Prolongar fecha oferta:</h4>";
                    echo "Fecha inicio: ".$Fecha_Inicio."<br>";
                    if (isset($Fecha_Fin)){
                         echo "Fecha fin: ".$Fecha_Fin;
                    } else{
                        echo "Fecha fin: La fecha de fin no está especificada.";
                    }
                   

                    echo "<div id='formCambiarFechaOferta'>";
                
                    if (isset($Fecha_Fin)) {
                        echo '<form action="cambiarFecha.php" method="post">';
                        
                        echo "<input type='hidden' name='Id_Oferta' value='$Id_Oferta'></input>";
                        echo "<input type='hidden' name='Fecha_Fin' value='$Fecha_Fin'></input>";
                        
                    
                    

                        if (strtotime($Fecha_Fin) >= strtotime($Fecha_Inicio)) {
                            echo '<input type="submit" name="quitarMes" value="-1 mes">';
                        }


                        echo '</form>';

                        echo '<form action="cambiarFecha.php" method="post">';
                        echo "<input type='hidden' name='Id_Oferta' value='$Id_Oferta'></input>";
                        echo "<input type='hidden' name='Fecha_Fin' value='$Fecha_Fin'></input>";
                        echo '<input type="submit" name="anadirMes" value="+1 mes">';
                        echo '</form>';

                    }
                    
                    echo "</div>";
                }

            
?>
            </article>

            <a href="index.php"><button>Mis ofertas</button></a>

        </section>
    </div>
    <?php include "../../Footer/footer.php"; ?>
</body>

</html>
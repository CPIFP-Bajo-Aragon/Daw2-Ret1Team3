<link rel="shortcut icon" href="../../../Imagenes/icon/icon.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<?php
include "../../Funciones/conexion.php";


$username = $_SESSION['Nombre_Usuario'];
$dni = $_SESSION['dni'];
if($_SESSION['Tipo_Usuario']=='Alumno'){
    session_abort();
    header("Location: /");
    exit;
}else if($_SESSION['Tipo_Usuario']=='Admin'){
    session_abort();
    header("Location: /");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Estilos/alumno.css">
    <script src="cargarMunicipios.js"></script>

    <title>Document</title>
</head>

<body>
    <main>

        <?php include "../../Header/CabeceraLogeado.php"; ?>
        <link rel="stylesheet" href="../../Estilos/alumno.css">
        <div class="main-content">
            <?php include "../../menuLateral/Empresa/menuEmpresa.php"; ?>
            <section class="main-info">
                <div class="breadcrumbs">
                    <h1 id="breadcrumbs-title">Empresa / <span>Crear ofertas</span></h1>
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

                <?php
                            $sql="SELECT * FROM Empresa WHERE DNI_CIF='$dni'";
                            if($resultado = $conexion -> query($sql)){
                                while($row = $resultado->fetch(PDO::FETCH_OBJ)){
                                    $activo=$row->Activo;

                                    if($activo==1){
                                    ?>
                <article class="card">
                    <h2>Formulario de Inserción de Datos</h2>

                    <div class="divCrearOferta">
                        <form action="Insertar_Oferta.php" class="formCrearOferta" method="post">

                            <label for="titulo">Titulo: <span class="campo-obligatorio">*</span></label>

                            <input type="text" name="titulo" required>
                            <br>
                            <label for="vacantes">Vacantes: <span class="campo-obligatorio">*</span></label>

                            <input type="number" name="vacantes" required min="0">
                            <br>
                            <label for="descripcion">Descripcion: <span class="campo-obligatorio">*</span></label>

                            <textarea name="descripcion" required></textarea>
                            <br>
                            <label for="fecha_inicio">Fecha_Inicio:<span class="campo-obligatorio">*</span></label>

                            <input type="date" name="fecha_inicio" required>
                            <br>
                            <label for="fecha_fin">Fecha_Fin:</label>
                            <input type="date" name="fecha_fin">
                            <br>


                            <?php
                            // Asumiendo que $id_pais se obtiene de algún lugar, ajusta esto según tu lógica
                            $id_pais = isset($_POST['id_pais']) ? $_POST['id_pais'] : null;
                            ?>

                            <!-- Continuación de tu código HTML y PHP -->
                            <label for="Pais">País: <span class="campo-obligatorio">*</span></label>
                            <select name="Pais" id="Pais">
                                <?php
                                $query = "SELECT * FROM paises";
                                if ($result = $conexion->query($query)) {
                                    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                                        $Id_Pais = $row->id;
                                        $Nombre_Pais = $row->nombre;
                                        echo "<option value='$Id_Pais'>$Nombre_Pais</option>";
                                    }
                                }
                                ?>
                            </select>
                            <br>
                            <label for="municipios">Municipio:</label>
                            <select name="municipios" id="municipios" class="inicio-alumno">
                            </select>
                            <label for="titulo">Movilidad:</label>
                            Si<input type="radio" id="Movilidad" name="Movilidad" value="1">
                            No<input type="radio" id="Movilidad" name="Movilidad" value="0">

                            <label for="titulo">Coche Propio:</label>
                            Si<input type="radio" id="Coche" name="Coche" value="1">
                            No<input type="radio" id="Coche" name="Coche" value="0">
                            <input type="hidden" name="dni" value="<?php echo $dni; ?>">
                            <input type="submit" name="insertar" value="Insertar Datos">
                        </form>
                        </select>
                        <!-- Contenedor del alerta -->
                        <div id="alert-container" class="hidden">
                            <div class="alert-box">
                                <span class="close-btn" onclick="closeAlert()">×</span>
                                <p>En caso de que se introduzca algún elemento de manera incorrecta, podrá editarse toda
                                    la información
                                    de la oferta cuándo finalice.
                                </p>
                            </div>
                        </div>
                        <?php
                            }else{  
                                ?>
                        <article class="card">
                            <h2 class="card-title">Crear Ofertas</h2>
                            <hr class="hr-divider">
                            <p class='mensaje-error'>Tienes que estar validado para poder crear una oferta</p>
                        </article>
                        <?php
                                    } 
                                }
                                ?>
                        <?php 
                            }
                           ?>
                    </div>

                </article>
            </section>
        </div>
        <div class="footer">
            <?php include "../../Footer/footer.php"; ?>
        </div>
    </main>

    <script src="alert.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Document</title>
    <script src="cargarMunicipios.js"></script>

    <?php include "../../Funciones/conexion.php"; ?>
    <?php
          if($_SESSION['Tipo_Usuario']=='Alumno'){
        session_abort();
        session_destroy();
        header("Location: /");
        exit;
    }else if($_SESSION['Tipo_Usuario']=='Empresa'){
        session_abort();
        session_destroy();
        header("Location: /");
        exit;
    } 
    $dni = $_SESSION['dni'];
    $username = $_SESSION['Nombre_Usuario'];

    function cerrarSesion(){
    session_destroy();
    }

    ?>
</head>

<body>
    <?php
   
    if($_SESSION['Tipo_Usuario']!='Admin'){
        //echo "Acceso no permitido";
         header("Location: ../PermisoDenegado.php"); 
    }else{

    }
    ?>


    <?php
       
        echo "<a href=\"../login.php\">Ir a inicio</a>";
    ?>

    <main>
        <?php include "../../Header/CabeceraLogeado.php"; ?>


        <link rel="stylesheet" href="../../Estilos/alumno.css">
        <div class="main-content">
            <?php include "../../menuLateral/Admin/menuAdmin.php"; ?>
            <section class="main-info">

                <div class="breadcrumbs">
                    <h1 id="breadcrumbs-title">Admin / <span>Crear Oferta</span></h1>
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
                    <h2 class="card-title">Crear Oferta</h2>
                    <hr class="hr-divider">
                    <div class="cardContent">
                        <div class="cardInfo">

                            <div class="divCrearOferta">
                                <form action="crear_oferta.php" class="formCrearOferta" method="POST">

                                    <label for="titulo">Nombre de la Empresa: <span
                                            class="campo-obligatorio">*</span></label>
                                    <select name="empresa">
                                        <?php
                            $sql = "SELECT * FROM Usuario WHERE Tipo_Usuario='Empresa'";
                                if ($result = $conexion->query($sql)) {
                                    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                                        $nombre = $row->Nombre_Usuario;
                                        $dni = $row->DNI_CIF;

                                        echo "
                                            <option value='$dni'>
                                                $nombre
                                            </option>
                                        ";
                                    }
                                }
                                ?>
                                    </select>


                                    <label for="titulo">Titulo: <span class="campo-obligatorio">*</span></label>

                                    <input type="text" name="titulo" required>
                                    <br>
                                    <label for="vacantes">Vacantes: <span class="campo-obligatorio">*</span></label>

                                    <input type="number" name="vacantes" required min="0">
                                    <br>
                                    <label for="descripcion">Descripcion: <span
                                            class="campo-obligatorio">*</span></label>

                                    <textarea name="descripcion" required></textarea>
                                    <br>
                                    <label for="fecha_inicio">Fecha_Inicio:<span
                                            class="campo-obligatorio">*</span></label>

                                    <input type="date" name="fecha_inicio" required>
                                    <br>
                                    <label for="fecha_fin">Fecha_Fin:</label>
                                    <input type="date" name="fecha_fin">
                                    <br>


                                    <?php
                            $id_pais = isset($_POST['id_pais']) ? $_POST['id_pais'] : null;
                            ?>

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

                                    <input type="hidden" name="dni" value="<?php echo $dni;?>">
                                    <input type="submit" name="insertar" value="Insertar Datos">
                                </form>
                            </div>
                        </div>
                    </div>
                </article>

            </section>
        </div>
        <div class="footer">
            <?php include "../../Footer/footer.php"; ?>
        </div>
    </main>
</body>

</html>
<?php
        include "../../Funciones/conexion.php";

session_start();

$dni = $_SESSION['dni'];

$query = "SELECT * FROM Empresa WHERE DNI_CIF='$dni'";

if ($result = $conexion->query($query)) {
    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
        $Id_municipio = $row->Id_Municipio;
    }
}
?>

  <h2>Formulario de Inserción de Datos</h2>

  <div id="ocultar">
        <form action="Crear_Oferta.php" method="post">

            <label for="titulo">Titulo:</label>
            <input type="text" name="titulo" required>
            <br>
            <label for="vacantes">Vacantes:</label>
            <input type="number" name="vacantes" required>
            <br>
            <label for="descripcion">Descripcion:</label>
            <textarea name="descripcion" required></textarea>
            <br>
            <label for="fecha_inicio">Fecha_Inicio:</label>
            <input type="date" name="fecha_inicio" required>
            <br>
            <label for="fecha_fin">Fecha_Fin:</label>
            <input type="date" name="fecha_fin">
            <br>
            <input type="hidden" name="dni" value="<?php echo $dni; ?>">
            <br>
            <select name="municipios" id="municipios" class="inicio-alumno">
            <?php
            $query = "SELECT * FROM Municipio";
            if ($result = $conexion->query($query)) {
                while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                    $Nombre_Municipio = $row->Nombre_Municipio;
                    $id_Municipio = $row->Id_Municipio;
                    echo "<option value='$id_Municipio'>$Nombre_Municipio</option>";
                }
            }
            ?>
            <input type="submit" name="insertar" value="Insertar Datos">
        </form>
  </div>
<?php
  if (isset($_POST["insertar"])) {
    $dni = $_SESSION['dni'];
    $titulo = $_POST['titulo'];
    $vacantes = $_POST['vacantes'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $Id_municipio= $_POST['municipios'];
       


        if($fecha_fin!=""){
            $sentencia = $conexion->prepare("INSERT INTO Oferta(Titulo, Vacantes, Descripcion, Fecha_Inicio, Fecha_Fin, DNI_CIF, Id_Municipio) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $sentencia->bindParam(1, $titulo);
            $sentencia->bindParam(2, $vacantes);
            $sentencia->bindParam(3, $descripcion);
            $sentencia->bindParam(4, $fecha_inicio);
            $sentencia->bindParam(5, $fecha_fin);
            $sentencia->bindParam(6, $dni);
            $sentencia->bindParam(7, $Id_municipio);
        }else{
            $sentencia = $conexion->prepare("INSERT INTO Oferta(Titulo, Vacantes, Descripcion, Fecha_Inicio, DNI_CIF, Id_Municipio) VALUES (?, ?, ?, ?, ?, ?)");
            $sentencia->bindParam(1, $titulo);
            $sentencia->bindParam(2, $vacantes);
            $sentencia->bindParam(3, $descripcion);
            $sentencia->bindParam(4, $fecha_inicio);
            $sentencia->bindParam(5, $dni);
            $sentencia->bindParam(6, $Id_municipio);
        }
        try {
            $sentencia->execute();
        } catch (PDOException $e) {
            echo "error";
        } 
        ?>
        <style>
            #ocultar{
                display: none;
            }
        </style>
        
        <form action="" method="post">
        <label for="titulo">Titulo:</label>
        <input type="text" name="titulo" value="<?php echo $titulo ?>"required>
        <br>
        <label for="vacantes">Vacantes:</label>
        <input type="number" name="vacantes" value="<?php echo $vacantes  ?>" required>
        <br>
        <label for="descripcion">Descripcion:</label>
        <textarea name="descripcion" value="<?php echo $descripcion ?>" required></textarea>
        <br>
        <label for="fecha_inicio">Fecha_Inicio:</label>
        <input type="date" name="fecha_inicio" value="<?php echo $fecha_inicio ?>" required>
        <br>
        <label for="fecha_fin">Fecha_Fin:</label>
        <input type="date" name="fecha_fin" value="<?php echo $fecha_fin ?>">
        <hr>

        </select>
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
        <br>
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
        <br>
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

        </form> 
    <?php
}
?>
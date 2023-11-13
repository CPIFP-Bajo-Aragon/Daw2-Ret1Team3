<?php include "../../Funciones/SessionStart.php";?>

<?php include "../../Funciones/conexion.php";?>

<form method="POST" action="./Titulaciones/actualizar.php">

<?php

$dni = $_SESSION['dni'];

?>


        <label for="centros">Centro:</label>
        <select name="centros" id="centros">
            <?php

                $query = "SELECT * FROM Centro";

                
                if ($result = $conexion->query($query)) {
                    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                        $Id_Centro = $row->Id_Centro;
                        $Nombre_Centro = $row->Nombre_Centro;
                        $Id_Municipio = $row->Id_Municipio; ?> <option value="<?php echo $Id_Centro?>"><?php echo $Nombre_Centro?></option> <?php
                    }
                }
                ?>

        </select>




    <label for="Fecha_Inicio">Fecha_Inicio:</label>
    <input type="date" name="Fecha_Inicio" required><br>

    <label for="Fecha_Fin">Fecha_Fin:</label>
    <input type="date" name="Fecha_Fin"><br>

    <label for="Titulo">Titulo:</label>
        <select name="titulos" id="titulos">
            <?php

                $query = "SELECT * FROM Titulacion";

                
                if ($result = $conexion->query($query)) {
                    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                        $Id_Tipo_Titulacion = $row->Id_Tipo_Titulacion;
                        $Nombre_Titulacion = $row->Nombre;
                        $Sector = $row->Sector;
                        $Activo = $row->Activo;
                        $Tipo = $row->Tipo;
                        $Horas = $row->Horas;
                        ?> <option value="<?php echo $Id_Tipo_Titulacion?>"><?php echo $Tipo." - ".$Nombre_Titulacion?></option> <?php
                    }
                }
                ?>

        </select>




  
    <input type="submit" value="Añadir Titulación">
</form>


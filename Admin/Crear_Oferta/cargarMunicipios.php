<?php
include "../../Funciones/conexion-inicio.php";

if (isset($_POST['id_pais'])) {
    $idPais = $_POST['id_pais'];
 
    if ($idPais == 73) {
        try {
            // OBTENER LOS MUNICIPIOS DE ESPAÑA
            $query = "SELECT * FROM Municipio";
 
               if ($result = $conexion->query($query)) {
                        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                            $Id_Municipio = $row->Id_Municipio;
                            $Nombre_Municipio = $row->Nombre_Municipio;
                         echo "<option name='muncipio' value='$Id_Municipio'>$Nombre_Municipio</option>";
                        
                        }
                    

                    }else {
                
                echo "<option value=''>Error al cargar municipios</option>";
            }
       } catch (PDOException $e) {

    echo "<option value=''>Error de conexión a la base de datos: " . $e->getMessage() . "</option>";
}

    } else {

        echo "<option value=''>Selecciona un país válido</option>";
    }
}
?>
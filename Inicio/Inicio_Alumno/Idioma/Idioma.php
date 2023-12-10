<?php include "../../Funciones/conexion.php";
$dni = $_SESSION['dni'];





$query="SELECT Idioma.Idioma, Nivel.Nivel, Idioma.Id_Idioma
FROM Idioma
JOIN Nivel_Idioma ON Idioma.Id_Idioma = Nivel_Idioma.Id_Idioma
JOIN Nivel ON Nivel.Id_Nivel = Nivel_Idioma.Id_Nivel
WHERE Nivel_Idioma.DNI_CIF = '$dni'";


    if ($result = $conexion->query($query)) {
      if ($result->rowCount() > 0) {
        ?>
<table>
    <tr>
        <th>Idioma</th>
        <th>Nivel</th>
        <th>Acciones</th>
    </tr>
    <?php

    } else{
        echo "Aún no has añadido ningún idioma.";
    }
    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
        $Idioma = $row -> Idioma;
        $Nivel = $row->Nivel;
        $Id_Idioma = $row->Id_Idioma;
    
        echo " 
        <td> $Idioma</td>
        <td> $Nivel</td>"
        ?>
    <td>

        <form id='formulario9' action="Idioma/eliminarIdioma.php" method="POST">
            <input type="hidden" name="id_Idioma" value="<?php echo $Id_Idioma;?>">
            <input type="submit" name="borrar" value="🗑️">

        </form>

        <?php

        echo "</tr>";
    }

}
?>

</table>
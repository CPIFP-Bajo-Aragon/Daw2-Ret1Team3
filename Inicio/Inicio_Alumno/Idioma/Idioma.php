
<?php include "../../Funciones/conexion.php";
$dni = $_SESSION['dni'];
?>
    <form method="POST" action="Idioma/añadirIdioma.php" >
        <p>Idioma</p>
        <select name="Idioma" id="">
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
            </select>
            <?php 
        }
        ?>
        <p>Nivel</p>    
        <select name="Nivel" id="">
        <?php 
        $sql="SELECT * FROM Nivel";
        if($resultado = $conexion -> query($sql)){
            ?>
                <option value="">- Nivel -</option>
                <?php
            while($row = $resultado->fetch(PDO::FETCH_OBJ)){
                $Nivel= $row-> nivel;
                $Id_Nivel=$row-> Id_Nivel;
                ?>
                <option value="<?php echo $Id_Nivel?>"><?php echo $Nivel?></option>
                <?php 

            }
            ?>
            </select>
            <?php 
        }
        ?>

        </select>
        <input type="submit" name="AñadirIdioma" value="Añadir Idioma">
    </form>
    <table>
    <tr>
        <th>Idioma</th>
        <th>Nivel</th>
        <th>Acciones</th>
    </tr>
    
<?php 


$query="SELECT Idioma.Idioma, Nivel.Nivel, Idioma.Id_Idioma
FROM Idioma
JOIN Nivel_Idioma ON Idioma.Id_Idioma = Nivel_Idioma.Id_Idioma
JOIN Nivel ON Nivel.Id_Nivel = Nivel_Idioma.Id_Nivel
WHERE Nivel_Idioma.DNI_CIF = '$dni'";

if ($result = $conexion->query($query)) {
    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
        $Idioma = $row -> Idioma;
        $Nivel = $row->Nivel;
        $Id_Idioma = $row->Id_Idioma;
    
        echo " 
        <td> $Idioma</td>
        <td> $Nivel</td>
        <td>"
        ?>
        <form action="Idioma/eliminarIdioma.php" method="POST">
            <input type="hidden" name="Idioma" value="<?php echo $Id_Idioma;?>">
            <input type="submit" value="Borrar">
        </form>
        <?php
        echo"
        </td>";
        echo "</tr>";
    }

}
?>

</table>
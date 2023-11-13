<form action="Habilidades_personales/guardar_habilidades.php" method="post">
<select name="Soft_Skill" id="Soft_Skill">
            <?php

                $query = "SELECT * FROM Soft_Skill";

                
                if ($result = $conexion->query($query)) {
                    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                        $Id_Soft = $row->Id_Soft;
                        $nombre = $row->nombre;
                        
                        ?> <option value="<?php echo $Id_Soft?>"><?php echo $nombre?></option> <?php
                    }
                }
                ?>
</select>
<input type="submit" value="Añadir">
</form>
<table>

<?php
$dni = $_SESSION['dni'];
                $query = "SELECT Soft_Skill.Id_Soft, Soft_Skill.nombre FROM Soft_Skill, Soft_Skill_Alumno WHERE Soft_Skill.Id_Soft=Soft_Skill_Alumno.Id_Soft AND DNI_CIF='$dni'; ";


                if ($result = $conexion->query($query)) {
                    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                        $Id_Soft = $row->Id_Soft;
                        $nombre = $row->nombre;
                        
                        ?> 

                        <tr>
                        <td><?php echo $nombre?></td>
                        <td>   <form action="Habilidades_personales/borrarhabilidad.php" method="post">
                        <input type="text" name="id_soft" value="<?php echo $Id_Soft;?>" style="display: none;">
                        <input type="submit" value="Borrar">
                        </form>
                    </td>
                        </tr>
                        <?php
                    }
                }
                ?>

</table>
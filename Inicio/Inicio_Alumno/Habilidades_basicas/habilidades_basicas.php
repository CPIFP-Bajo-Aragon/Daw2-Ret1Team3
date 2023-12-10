<form action="Habilidades_basicas/guardar_habilidades.php" method="post">
<select name="Hard_Skill" id="Hard_Skill" class="js-example-basic-single"  name="states[]">
            <?php

                $query = "SELECT * FROM Hard_Skill";
                $prevTipo = null; 

                if ($result = $conexion->query($query)) {
                    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                        $Id_Hard = $row->Id_Hard;
                        $nombre = $row->nombre;
                        $tipo = $row->tipo;

                        if ($tipo !== $prevTipo) { 
                            if ($prevTipo !== null) {
                                echo "</optgroup>";
                            }
                            echo "<optgroup label=\"$tipo\">";
                            $prevTipo = $tipo; 
                        }

                        echo "<option value=\"$Id_Hard\">$nombre</option>";
                    }

                    if ($prevTipo !== null) {
                        echo "</optgroup>";
                    }
                }

                ?>
</select>
<input type="submit" value="Añadir">
</form>
<table>

<?php
$dni = $_SESSION['dni'];
                $query = "SELECT Hard_Skill.Id_Hard, Hard_Skill.nombre FROM Hard_Skill, Hard_Skill_Alumno WHERE Hard_Skill.Id_Hard=Hard_Skill_Alumno.Id_Hard AND DNI_CIF='$dni'; ";


                if ($result = $conexion->query($query)) {
                    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                        $Id_Hard = $row->Id_Hard;
                        $nombre = $row->nombre;
                        
                        ?> 

                        <tr>
                        <td><?php echo $nombre?></td>
                        <td>   <form action="Habilidades_basicas/borrarhabilidad.php" method="post">
                        <input type="text" name="id_Hard" value="<?php echo $Id_Hard;?>" style="display: none;">
                        <input type="submit" value="🗑️">
                        </form>
                    </td>
                        </tr>
                        <?php
                    }
                }
                ?>

</table>
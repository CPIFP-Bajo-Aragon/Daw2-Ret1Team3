<?php include "../../Funciones/SessionStart.php";?>

<?php include "../../Funciones/conexion.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?php


$dni = $_SESSION['dni'];


$query = "SELECT Centro.Nombre_Centro, Centro.Id_Centro, Titulacion_Centro_Persona.Fecha_Inicio, Titulacion_Centro_Persona.Fecha_Fin, Titulacion.Nombre, Titulacion.Id_Tipo_Titulacion FROM Centro, Alumno, Titulacion, Titulacion_Centro_Persona WHERE Centro.Id_Centro = Titulacion_Centro_Persona.Id_Centro AND Alumno.DNI_CIF = Titulacion_Centro_Persona.DNI_CIF AND Titulacion.Id_Tipo_Titulacion = Titulacion_Centro_Persona.Id_Tipo_Titulacion AND Alumno.DNI_CIF = :dni";

$stmt = $conexion->prepare($query);
$stmt->bindParam(':dni', $dni);
$stmt->execute();

echo '<table>
      <tr>
        <th>Nombre del Centro</th>
        <th>Fecha de Inicio</th>
        <th>Fecha de Fin</th>
        <th>Nombre de la Titulación</th>
        <th>Acciones</th>
      </tr>';
    
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $Id_Centro = $row['Id_Centro'];
        $Id_Tipo_Titulacion = $row['Id_Tipo_Titulacion'];
        $Fecha_Inicio = $row['Fecha_Inicio'];

        echo '<tr>';
        echo '<td>' . $row['Nombre_Centro'] . '</td>';
        echo '<td>' . $row['Fecha_Inicio'] . '</td>';
        echo '<td>' . $row['Fecha_Fin'] . '</td>';
        echo '<td>' . $row['Nombre'] . '</td>';
        ?>
        <td>
            <form action="Titulaciones/eliminarTitulaciones.php" method="POST">
                <input type="hidden" name="Id_Centro"  value=<?php echo $Id_Centro; ?>>
                <input type="hidden" name="Id_Tipo_Titulacion"  value=<?php echo $Id_Tipo_Titulacion; ?>>
                <input type="submit" value="Borrar">
            </form>
        </td>
        <?php
        echo '</tr>';
    }
    echo "</table>";
    

?>

<br>
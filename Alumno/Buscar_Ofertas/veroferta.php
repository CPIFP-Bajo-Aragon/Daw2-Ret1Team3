<?php
$consulta ="SELECT Oferta.Titulo, Oferta.Vacantes, Oferta.Fecha_Inicio, Oferta.Fecha_Fin, Usuario.Nombre_Usuario, Oferta.Descripcion, Idioma.Idioma, Nivel.nivel, Titulacion.Nombre, Soft_Skill.nombre AS Nombre_soft, Hard_Skill.nombre AS Nombre_hard, Hard_Skill.tipo
FROM Oferta, Usuario, Oferta_Nivel_Idioma, Nivel, Idioma, Oferta_Tipo_Titulacion, Titulacion, Oferta_Soft_Skill, Soft_Skill, Oferta_Hard_Skill, Hard_Skill
WHERE Oferta.Activo = 1 AND Oferta.DNI_CIF = Usuario.DNI_CIF AND Oferta_Nivel_Idioma.Id_Oferta = Oferta.Id_Oferta AND Oferta_Nivel_Idioma.Id_Nivel = Nivel.Id_Nivel AND Oferta_Nivel_Idioma.Id_Idioma = Idioma.Id_Idioma AND Oferta_Tipo_Titulacion.Id_Oferta = Oferta.Id_Oferta AND Titulacion.Id_Tipo_Titulacion = Oferta_Tipo_Titulacion.Id_Tipo_Titulacion AND Oferta_Soft_Skill.Id_Oferta = Oferta.Id_Oferta AND Oferta_Soft_Skill.Id_Soft = Soft_Skill.Id_Soft AND Oferta_Hard_Skill.Id_Oferta = Oferta.Id_Oferta AND Oferta_Hard_Skill.Id_Hard = Hard_Skill.Id_Hard";

$statement = $conexion->prepare($consulta);
$statement->execute();
$numFilas = $statement->rowCount();

//echo $numFilas;
if($numFilas<1){
    echo "<h2>Empresa: ".$fila->Nombre_Usuario."</h2>";
    echo "<p>Puesto de trabajo: ".$fila->Titulo."</p>";
    echo "<p>Vacantes: ".$fila->Vacantes."</p>";
    echo "<p>Fecha inicio: ".$fila->Fecha_Inicio."</p>";
    echo "<p>Descripcion: ".$fila->Descripcion."</p>"; 
}else{
$leeroferta = $conexion -> query($consulta);
while($fila = $leeroferta->fetch(PDO::FETCH_OBJ)){
    echo "<p>Idioma: ".$fila->Idioma." - ".$fila->nivel."</p>";
    echo "<p>Titulacion: ".$fila->Nombre."</p>";
    echo "<p>Soft skills: ".$fila->Nombre_soft."</p>";
    echo "<p>Hard skills: ".$fila->Nombre_hard."</p>";
}                               
}

?>
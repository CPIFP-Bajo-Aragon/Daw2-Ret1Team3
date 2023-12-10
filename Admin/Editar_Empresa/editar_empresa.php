<?php
include "../../Funciones/conexion.php";
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
if(isset($_GET['resultado'])){
    if($_GET['resultado']=="true"){
        ?>
        <script>
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Se a realizado los cambios",
            showConfirmButton: false,
            timer: 1500
          });
          </script>
        <?php
    }
    if($_GET['resultado']=="false"){
        ?>
        <script>
        Swal.fire({
            position: "center",
            icon: "error",
            title: "No se han realizado los cambios",
            showConfirmButton: false,
            timer: 1500
          });
          </script>
        <?php
    }
    }
?>
<form action="index.php" method="post">
<select name="empresa" id="">
<?php 
$sql="SELECT * FROM Usuario, Empresa WHERE Tipo_Usuario='Empresa' AND Usuario.DNI_CIF=Empresa.DNI_CIF";
if($resultado = $conexion -> query($sql)){
    ?>
        <option value="">- Empresa -</option>
        <?php
    while($row = $resultado->fetch(PDO::FETCH_OBJ)){
        $nombreuser= $row-> Nombre_Usuario;
        $dniuser=$row-> DNI_CIF;
        ?>
        <option value="<?php echo $dniuser?>"><?php echo $nombreuser." - ".$dniuser?></option>
        <?php 
    }
    ?>
    </select>
    <?php 
}
?>
<input type="submit" name="editarUser" value="Editar">
</form>
<?php
if(isset($_POST['editarUser'])){

    $dnicifUser=$_POST['empresa'];

    if($_POST['empresa']==""){
        
    }else{
    
    $sqlw="SELECT * FROM Usuario, Empresa WHERE Tipo_Usuario='Empresa' AND Usuario.DNI_CIF=Empresa.DNI_CIF AND Empresa.DNI_CIF='$dnicifUser'";
    //echo $sqlw;
    if($resultado = $conexion -> query($sqlw)){
        while($row = $resultado->fetch(PDO::FETCH_OBJ)){
            $Empresa=$row -> Nombre_Usuario;
            $Ntrabajadores=$row -> Numero_Trabajadores;
            $Web=$row -> Web;
            $Telefono=$row -> Telefono;
            $AreaNegocio=$row -> Area_Negocio;
            $Descripcion=$row -> Descripcion;
            $Direccion=$row -> Direccion;
            $idmunicipio=$row -> Id_Municipio;
            $idpais= $row -> Pais;
            $dniEmpresa= $row -> DNI_CIF;
        }

    }

    ?>
    <form action="cambiar_empresa.php" method="post">
        <label for="">Empresa:</label>
        <input type="text" name="empresa" id="" value="<?php echo $Empresa ?>">
        <label for="">Numero trabajadores:</label>
        <input type="text" name="ntrabaja" id="" value="<?php echo $Ntrabajadores ?>">
        <label for="">Web:</label>
        <input type="text" name="web" id="" value="<?php echo $Web ?>">
        <label for="">Telefono:</label>
        <input type="text" name="tel" id="" value="<?php echo $Telefono ?>">
        <label for="">Area negocio:</label>
        <select name="areaneg" id="areaneg" class="js-example-basic-single"  name="states[]">
            <?php
            $query = "SELECT * FROM AreasDeNegocio where ID=$AreaNegocio"; 
            if ($result = $conexion->query($query)) {
                while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                    $Nombre_area = $row->Nombre;
                    $Id_area = $row->ID;
                    echo "<option value='$Id_area'>$Nombre_area</option>";
                }
            }

            $query = "SELECT * FROM AreasDeNegocio ORDER BY Nombre ASC"; 

            if ($result = $conexion->query($query)) {
                while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                    $Nombre_area = $row->Nombre;
                    $Id_area = $row->ID;
                    echo "<option value='$Id_area'>$Nombre_area</option>";
                }
            }
            ?>
        </select>
        <label for="">Descripcion :</label>
        <textarea name="desc" id="" cols="30" rows="10"><?php echo $Descripcion ?></textarea>
        <label for="">Direccion :</label>
        <input type="text" name="dirr" id="" value="<?php echo $Direccion ?>">
        <label for="">Municipio:</label>
        <select name="municipios" id="municipios" class="js-example-basic-single"  name="states[]">
            <?php
            $query = "SELECT * FROM Municipio where Id_Municipio=$idmunicipio"; 
            if ($result = $conexion->query($query)) {
                while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                    $Nombre_Municipio = $row->Nombre_Municipio;
                    $id_Municipio = $row->Id_Municipio;
                    echo "<option value='$id_Municipio'>$Nombre_Municipio</option>";
                }
            }

            $query = "SELECT * FROM Municipio ORDER BY Nombre_Municipio ASC"; 

            if ($result = $conexion->query($query)) {
                while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                    $Nombre_Municipio = $row->Nombre_Municipio;
                    $id_Municipio = $row->Id_Municipio;
                    echo "<option value='$id_Municipio'>$Nombre_Municipio</option>";
                }
            }
            ?>
        </select>

        <label for="">Pais:</label>
        <select name="pais" id="pais" class="js-example-basic-single"  name="states[]">
            <?php
            $query = "SELECT * FROM paises where id=$idpais"; 
            if ($result = $conexion->query($query)) {
                while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                    $pais = $row->nombre;
                    $id_pais = $row->id;
                    echo "<option value='$id_pais'>$pais</option>";
                }
            }

            $query = "SELECT * FROM paises ORDER BY nombre ASC"; 

            if ($result = $conexion->query($query)) {
                while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                    $pais = $row->nombre;
                    $id_pais = $row->id;
                    echo "<option value='$id_pais'>$pais</option>";
                }
            }
            ?>
        </select>
        <input type="hidden" name="dniEmpresa" id="" value="<?php echo $dniEmpresa ?>">
        <input type="submit" name="guardarCambios" value="Guardar cambios">
    </form>
<?php
}
}
?>

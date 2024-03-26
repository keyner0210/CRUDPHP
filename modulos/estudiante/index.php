<?php 
include("../../conexion.php");

// Obtener la lista de contactos
$stm = $conexion->prepare("SELECT * FROM estudiantes");
$stm->execute();
$contactos = $stm->fetchAll(PDO::FETCH_ASSOC);

// Procesar la eliminación si se proporciona un ID en la URL
if(isset($_GET['id'])){
    $txtid = $_GET['id'];
    
    $stmt = $conexion->prepare("DELETE FROM estudiantes WHERE id=:id");
    $stmt->bindParam(":id", $txtid, PDO::PARAM_INT);
    
    if($stmt->execute()){
        header("Location: index.php");
        exit(); // Terminar el script después de redirigir
    } else {
        echo "Error al eliminar el registro";
    }
}


?>

<?php include("../../template/header.php"); ?>

<!-- Botón para agregar nuevo estudiante -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
    Nuevo
</button>

<div class="table-responsive">
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Usuario_id</th>
                <th scope="col">Semestre</th>
                <th scope="col">Carrera</th>
                <th scope="col">Universidad</th>
                <th scope="col">Acciones</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contactos as $estudiante) { ?>
            <tr>
                <td><?php echo $estudiante['id'] ?></td>
                <td><?php echo $estudiante['semestre'] ?></td>
                <td><?php echo $estudiante['carrera'] ?></td>
                <td><?php echo $estudiante['universidad'] ?></td>
               
                <td>
                    <a href="edit.php?id=<?php echo $estudiante['id'] ?>" class="btn btn-success">Editar</a>
                    <a href="index.php?id=<?php echo $estudiante['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?')">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Incluir el formulario para agregar nuevo usuario -->
<?php include("create.php"); ?>

<?php include("../../template/footer.php"); ?>
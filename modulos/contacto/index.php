<?php 
include("../../conexion.php");

// Obtener la lista de contactos
$stm = $conexion->prepare("SELECT * FROM usuarios");
$stm->execute();
$contactos = $stm->fetchAll(PDO::FETCH_ASSOC);

// Procesar la eliminación si se proporciona un ID en la URL
if(isset($_GET['id'])){
    $txtid = $_GET['id'];
    
    $stmt = $conexion->prepare("DELETE FROM Usuarios WHERE id=:txtid");
    $stmt->bindParam(":txtid", $txtid);
    
    if($stmt->execute()){
        header("Location: index.php");
        exit(); // Terminar el script después de redirigir
    } else {
        echo "Error al eliminar el registro";
    }
}

?>

<?php include("../../template/header.php"); ?>

<!-- Botón para agregar nuevo usuario -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
    Nuevo
</button>

<div class="table-responsive">
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Fecha de Nacimiento</th>
                <th scope="col">Email</th>
                <th scope="col">Género</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contactos as $contacto) { ?>
            <tr>
                <td><?php echo $contacto['id'] ?></td>
                <td><?php echo $contacto['nombre'] ?></td>
                <td><?php echo $contacto['apellido'] ?></td>
                <td><?php echo $contacto['fecha_de_nacimiento'] ?></td>
                <td><?php echo $contacto['email'] ?></td>
                <td><?php echo $contacto['genero'] ?></td>
                <td><?php echo $contacto['telefono'] ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $contacto['id'] ?>" class="btn btn-success">Editar</a>
                    <a href="index.php?id=<?php echo $contacto['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?')">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Incluir el formulario para agregar nuevo usuario -->
<?php include("create.php"); ?>

<?php include("../../template/footer.php"); ?>
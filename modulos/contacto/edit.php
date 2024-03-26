<?php 
include("../../conexion.php");

// Verificar si se proporcionó un ID válido en la URL
if(isset($_GET['id'])){
    $txtid = $_GET['id'];
    
    // Preparar la consulta para obtener los datos del usuario
    $stm = $conexion->prepare("SELECT * FROM Usuarios WHERE id=:txtid");
    
    $stm->bindParam(":txtid", $txtid);
    
    // Ejecutar la consulta y obtener el registro del usuario
    if($stm->execute()){        
        $registro = $stm->fetch(PDO::FETCH_ASSOC);
        
        // Verificar si se encontró el registro
        if($registro){
            $nombre = $registro['nombre'];
            $apellido = $registro['apellido'];
            $fecha_de_nacimiento = $registro['fecha_de_nacimiento'];
            $email = $registro['email'];
            $genero = $registro['genero'];
            $telefono = $registro['telefono'];
        } else {
            // Registro no encontrado
            echo "No se encontró ningún registro con el ID proporcionado";
            exit; // Salir del script si no se encontró el registro
        }
    } else {
        // Error al ejecutar la consulta
        echo "Ocurrió un error al ejecutar la consulta";
        exit; // Salir del script si hubo un error en la consulta
    }
} else {
    // ID no proporcionado en la URL
    echo "No se proporcionó ningún ID en la URL";
    exit; // Salir del script si no se proporcionó un ID válido
}

// Procesar el formulario de actualización al recibir datos POST
if($_POST){ 
    // Asegurar la conexión a la base de datos
    if (!$conexion) {
        die("Error al conectar a la base de datos");
    }

    // Obtener los datos del formulario
    $txtid = isset($_POST['txtid']) ? $_POST['txtid'] : "";
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
    $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : "";
    $fecha_de_nacimiento = isset($_POST['fecha_de_nacimiento']) ? $_POST['fecha_de_nacimiento'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $genero = isset($_POST['genero']) ? $_POST['genero'] : "";
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : "";
    
    // Validar los datos de entrada
    if(empty($nombre) || empty($apellido) || empty($fecha_de_nacimiento) || empty($email) || empty($genero) || empty($telefono)){
        die("Por favor completa todos los campos.");
    }
    
    // Utilizar consultas preparadas de manera segura para actualizar los datos del usuario
    $stm = $conexion->prepare("UPDATE Usuarios SET nombre=:nombre, apellido=:apellido, fecha_de_nacimiento=:fecha_de_nacimiento, email=:email, genero=:genero, telefono=:telefono WHERE id=:txtid");
    $stm->bindValue(":nombre", $nombre); 
    $stm->bindValue(":apellido", $apellido);
    $stm->bindValue(":fecha_de_nacimiento", $fecha_de_nacimiento);
    $stm->bindValue(":email", $email); 
    $stm->bindValue(":genero", $genero); 
    $stm->bindValue(":telefono", $telefono);
    $stm->bindValue(":txtid", $txtid); 
    
    // Manejar posibles errores en la actualización de datos
    try {
        $stm->execute();
        header("location:index.php");
        exit; // Salir del script después de la redirección
    } catch (PDOException $e) {
        die("Error al actualizar los datos en la base de datos: " . $e->getMessage());
    }
} 
?>

<?php include("../../template/header.php"); ?>

<form action="" method="post">
    <div class="modal-body">
        <input type="hidden" class="form-control" name="txtid" value="<?php echo $txtid; ?>" placeholder="Ingresa nombre">

        <label for="">Nombre</label> 
        <input type="text" class="form-control" name="nombre" value="<?php echo $nombre; ?>" placeholder="Ingresa nombre" required>

        <label for="">Apellido</label>
        <input type="text" class="form-control" name="apellido" value="<?php echo $apellido; ?>" placeholder="Ingresa apellido" required>

        <label for="">Fecha de nacimiento</label>
        <input type="date" class="form-control" name="fecha_de_nacimiento" value="<?php echo $fecha_de_nacimiento; ?>" required>

        <label for="">Email</label>
        <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Ingresa email" required>

        <label for="">Género</label>
        <input type="text" class="form-control" name="genero" value="<?php echo $genero; ?>" placeholder="Ingresa género" required>

        <label for="">Teléfono</label>
        <input type="text" class="form-control" name="telefono" value="<?php echo $telefono; ?>" placeholder="Ingresa teléfono" required>
    </div>
    <div class="modal-footer">
        <a href="index.php" class="btn btn-danger">Cancelar</a>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>
</form>

<?php include("../../template/footer.php"); ?>

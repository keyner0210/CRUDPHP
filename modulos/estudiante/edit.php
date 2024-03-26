<?php 
include("../../conexion.php");

// Verificar si se proporcionó un ID válido en la URL
if(isset($_GET['id'])){
    $txtid = $_GET['id'];
    
    // Preparar la consulta para obtener los datos del usuario
    $stm = $conexion->prepare("SELECT * FROM estudiantes WHERE id=:txtid");
    
    $stm->bindParam(":txtid", $txtid);
    
    // Ejecutar la consulta y obtener el registro del usuario
    if($stm->execute()){        
        $registro = $stm->fetch(PDO::FETCH_ASSOC);
        
        // Verificar si se encontró el registro
        if($registro){
            $semestre = $registro['semestre'];
            $carrera = $registro['carrera'];
            $universidad = $registro['universidad'];
            
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
    $usuario_id = isset($_POST['usuario_id']) ? $_POST['usuario_id'] : "";
    $semestre = isset($_POST['semestre']) ? $_POST['semestre'] : "";
    $carrera = isset($_POST['carrera']) ? $_POST['carrera'] : "";
    $universidad = isset($_POST['universidad']) ? $_POST['universidad'] : "";
    
    // Validar los datos de entrada
    if(empty($semestre) || empty($carrera) || empty($universidad) ){
        die("Por favor completa todos los campos.");
    }
    
    // Utilizar consultas preparadas de manera segura para actualizar los datos del usuario
    $stm = $conexion->prepare("UPDATE estudiantes SET semestre=:semestre, carrera=:carrera,  WHERE id=:txtid");
    $stm->bindValue(":semestre", $semestre); 
    $stm->bindValue(":carrera", $carrera);
    $stm->bindValue(":universidad", $universidad);
    $stm->bindValue(":usuario_id", $usuario_id); 
    
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
        <input type="hidden" class="form-control" name="txtid" value="<?php echo $txtid; ?>" placeholder="">

        <label for="">carrera</label> 
        <input type="text" class="form-control" name="carrera" value="<?php echo $carrera; ?>" placeholder="Ingresa carrera" required>

        <label for="">semestre</label>
        <input type="text" class="form-control" name="semestre" value="<?php echo $semestre; ?>" placeholder="Ingresa semestre" required>

        <label for="">universidad</label>
        <input type="text" class="form-control" name="universidad" value="<?php echo $universidad; ?>"placeholder="Ingresa universidad" required>

    </div>
    <div class="modal-footer">
        <a href="index.php" class="btn btn-danger">Cancelar</a>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>
</form>

<?php include("../../template/footer.php"); ?>
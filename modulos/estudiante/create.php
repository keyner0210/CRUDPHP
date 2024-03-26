<?php
if($_POST){ 
    $semestre = isset($_POST['semestre']) ? $_POST['semestre'] : "";
    $carrera = isset($_POST['carrera']) ? $_POST['carrera'] : "";
    $universidad = isset($_POST['universidad']) ? $_POST['universidad'] : "";
    
    
    // Validar los datos de entrada
    if(empty($semestre) || empty($carrera) || empty($universidad) ){
        die("Por favor completa todos los campos.");
    }
    
    // Utilizar consultas preparadas de manera segura
    $stm = $conexion->prepare("INSERT INTO estudiantes(id, semestre, carrera, universidad) VALUES (null, :semestre, :carrera, :universidad)");
    $stm->bindParam(":semestre", $semestre); 
    $stm->bindParam(":carrera", $carrera);
    $stm->bindParam(":universidad", $universidad);
    
    
    // Manejar posibles errores en la inserción de datos
    try {
        $stm->execute();
        header("location:index.php");
    } catch (PDOException $e) {
        die("Error al insertar los datos en la base de datos: " . $e->getMessage());
    }
}
?>

<!-- Modal create -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
<div class="modal-dialog" role="document">
 <div class="modal-content"> <div class="modal-header"> 
<h5 class="modal-title" id="exampleModalLabel">AGREGAR ESTUDIANTE</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
<span aria-hidden="true">&times;</span>
</button> 
</div>
 <form action="" method="post">
 <div class="modal-body">
 <label for="">semestre</label> 
<input type="text" class="form-control" name="semestre" value="" placeholder="Ingresa semestre">

<label for="">carrera</label>
<input type="text" class="form-control" name="carrera" value="" placeholder="Ingresa carrera">

<label for="">universidad</label>
<input type="text" class="form-control" name="universidad" value="Ingresa universidad">



</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-primary">Guardar</button>
  </div>
  </form>
</div>
</div>
</div>

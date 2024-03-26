<?php

if($_POST){ 
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
    $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : "";
    $fecha_de_nacimiento = isset($_POST['fecha_de_nacimiento']) ? $_POST['fecha_de_nacimiento'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $Genero = isset($_POST['Genero']) ? $_POST['Genero'] : "";
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : "";
    
    // Validar los datos de entrada
    if(empty($nombre) || empty($apellido) || empty($fecha_de_nacimiento) || empty($email) || empty($Genero) || empty($telefono)){
        die("Por favor completa todos los campos.");
    }
    
    // Utilizar consultas preparadas de manera segura
    $stm = $conexion->prepare("INSERT INTO Usuarios(id, nombre, apellido, fecha_de_nacimiento, email, Genero, telefono) VALUES (null, :nombre, :apellido, :fecha_de_nacimiento, :email, :Genero, :telefono)");
    $stm->bindParam(":nombre", $nombre); 
    $stm->bindParam(":apellido", $apellido);
    $stm->bindParam(":fecha_de_nacimiento", $fecha_de_nacimiento);
    $stm->bindParam(":email", $email); 
    $stm->bindParam(":Genero", $Genero); 
    $stm->bindParam(":telefono", $telefono);
    
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
<h5 class="modal-title" id="exampleModalLabel">AGREGAR USUARIO</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
<span aria-hidden="true">&times;</span>
</button> 
</div>
 <form action="" method="post">
 <div class="modal-body">
 <label for="">Nombre</label> 
<input type="text" class="form-control" name="nombre" value="" placeholder="Ingresa nombre">

<label for="">Apellido</label>
<input type="text" class="form-control" name="apellido" value="" placeholder="Ingresa apellido">

<label for="">Fecha de nacimiento</label>
<input type="date" class="form-control" name="fecha_de_nacimiento" value="">

<label for="">Email</label>
<input type="text" class="form-control" name="email" value="" placeholder="Ingresa email">

<label for="">Genero</label>
<input type="text" class="form-control" name="Genero" value="" placeholder="Ingresa genero">

<label for="">Telefono</label>
<input type="text" class="form-control" name="telefono" value="" placeholder="Ingresa telefono">

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-primary">Guardar</button>
  </div>
  </form>
</div>
</div>
</div>
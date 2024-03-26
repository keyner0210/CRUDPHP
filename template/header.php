<?php $url_base="http://localhost/CRUD_PHP/"; ?>




<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
      
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

       
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="#" aria-current="page"
                        >CRUD PHP <span class="visually-hidden">(current)</span></a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base; ?>modulos/contacto/">Usuarios</a>
                    <a class="nav-link" href="<?php echo $url_base; ?>modulos/estudiante/">Estudiantes</a>
                </li>
            </ul>
        </nav>
        


        
        <main class="container">
            <br><br>
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script> 
</head>
<body class="bg-secondary">
    <header class="m-5 p-5 border border-2 bg-light">
        <h1>Mi blog de videojuegos</h1>
        <nav class="navbar navbar-expand-sm bg-light navbar-light">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">PS5</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Switch</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Xbox SX/S</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">PC</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="row m-5">
        <article class="col-8 border border-2 bg-light">
            Cuerpo de la pagina
        </article>


        <div class="col-1"></div>
        <aside class="col-3">
            <div class="row border border-2 bg-light">
                <h3 class="text-center">Log In</h3>
                <form name="login" class="p-3" action="login.php" method="post">
                    <label for="correo">Correo:<br>
                        <input type="mail" name="correo" id="correo">
                    </label><br>
                    <label for="contrasenia">Contraseña:<br>
                        <input type="password" name="contrasenia" id="contrasenia">
                    </label><br>
                    <br><input type="submit" value="Log in">
                </form>
            </div>

            <div class="row p-3"></div>

            <div class="row border border-2 bg-light">
                <h3 class="text-center">Sign In</h3>
                <form name="signin" class="p-3" action="registro.php" method="post">
                    <label for="nombre">Nombre:<br>
                        <input type="text" name="nombre" id="nombre">
                    </label><br>
                    <?php
                        if(isset($_SESSION["error_nombre"])){
                            if($_SESSION["error_nombre"]){
                                echo '<p style="color:red;">Error en el nombre</p>';
                            }
                        }
                    ?>

                    <label for="apellidos">Apellidos:<br>
                        <input type="text" name="apellidos" id="apellidos">
                    </label><br>
                    <?php
                        if(isset($_SESSION["error_apellidos"])){
                            if($_SESSION["error_apellidos"]){
                                echo '<p style="color:red;">Error en los apellidos</p>';
                            }
                        }
                    ?>

                    <label for="correo">Correo:<br>
                        <input type="mail" name="correo" id="correo">
                    </label><br>
                    <?php
                        if(isset($_SESSION["error_correo"])){
                            if($_SESSION["error_correo"]){
                                echo '<p style="color:red;">Introduzca un correo válido</p>';
                            }
                        }else if((isset($_SESSION["correo_existe"]))){
                            if($_SESSION["correo_existe"]){
                                echo '<p style="color:red;">ese correo ya esta en uso</p>';
                            }
                        }
                    ?>

                    <label for="contrasenia">Contraseña:<br>
                        <input type="password" name="contrasenia" id="contrasenia">
                    </label><br>
                    <?php
                        if(isset($_SESSION["error_contrasenia"])){
                            if($_SESSION["error_contrasenia"]){
                                echo '<p style="color:red;">Introduzca una contraseña válida</p>';
                            }
                        }

                        session_destroy();
                    ?>

                    <br><input type="submit" value="Sign in">
                </form>
            </div>
        </aside>
    </div>
</body>
</html>
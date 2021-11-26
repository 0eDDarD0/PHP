<?php
    session_start();

    if(isset($_SESSION['log_in'])){
        if($_SESSION['log_in']){
            $cuerpo = "col-12";
            $espacio = "d-none";
            $aside = "d-none";
        }else{
            $cuerpo = "col-8";
            $espacio = "col-1";
            $aside = "col-3";
        }
    }else{
        $cuerpo = "col-8";
        $espacio = "col-1";
        $aside = "col-3";
    }

?>

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

    <?php
        if(isset($_SESSION['sign_in'])){
            if($_SESSION['sign_in']){
                echo '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Usuario registrado con exito!</strong>
                    </div>';
            }
        }
    ?>

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
        <article class="<?php echo $cuerpo ?> border border-2 bg-light">
            <?php
                if(isset($_SESSION['log_in'])){
                    if($_SESSION['log_in']){
                        echo "Logeado como " . $_SESSION['log_in'];
                        echo "<br><a href=logout.php>Cerrar Sesion</a>";
                    }
                }
            ?>
        </article>


        <div class="<?php echo $espacio ?>"></div>
        <aside class="<?php echo $aside ?>">
            <div class="row border border-2 bg-light">
                <h3 class="text-center">Log In</h3>
                <form name="login" class="p-3" action="logeo.php" method="post">
                    <label for="correo">Correo:<br>
                        <input type="mail" name="correo" id="correo">
                    </label><br>
                    <label for="contrasenia">Contraseña:<br>
                        <input type="password" name="contrasenia" id="contrasenia">
                    </label><br>
                    <?php
                        if(isset($_SESSION["error_credenciales"])){
                            if($_SESSION["error_credenciales"]){
                                echo '<p style="color:red;">Las credenciales no son correctas</p>';
                            }
                            unset($_SESSION["error_credenciales"]);

                        }else if(isset($_SESSION["correo_no_registrado"])){
                            if($_SESSION["correo_no_registrado"]){
                                echo '<p style="color:red;">No existe un usuario con ese correo</p>';
                            }
                            unset($_SESSION["correo_no_registrado"]);
                        }
                    ?>
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
                            unset($_SESSION["error_nombre"]);
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
                            unset($_SESSION["error_apellidos"]);
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
                            unset($_SESSION["error_correo"]);

                        }else if((isset($_SESSION["correo_existe"]))){
                            if($_SESSION["correo_existe"]){
                                echo '<p style="color:red;">ese correo ya esta en uso</p>';
                            }
                            unset($_SESSION["correo_existe"]);
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
                            unset($_SESSION["error_contrasenia"]);
                        }

                    ?>

                    <br><input type="submit" value="Sign in">
                </form>
            </div>
        </aside>
    </div>
</body>
</html>
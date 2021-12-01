<?php
    include './modules/utilities.php';
    session_start();

    //ELEMENTOS A CARGAR SEGUN SI HAY LOGEO
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


    //ELEMENTOS A CARGAR EN LA PAGINA
    $con = 'mysql:dbname=proyecto1;host=localhost;charset=utf8';
    try{
        $db = new PDO($con, 'fer', 'root');

        //CARGAMOS TODAS LAS CATEGORIAS
        $categorias = getCategorias($db);
        

        //ENTRADAS A CARGAR SI SE HA ENTRADO EN ALGUNA CATEGORIA
        if(isset($_GET['cat'])){
            $entradas = getEntradas($db, $_GET['cat']);
        }

        //BORRAR CONEXION
        $db = NULL;
        unset($db);
        //MANEJO DE ERRORES
    }catch(PDOException $e){
        echo 'Error al conectar con la base de datos ' . $e->getMessage();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="./styles/entrada.css" rel="stylesheet">
</head>
<body class="bg-secondary">

    <?php //MENSAJE DE EXITO EN EL REGISTRO
        if(isset($_SESSION['sign_in'])){
            if($_SESSION['sign_in']){
                echo '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Usuario registrado con exito!</strong>
                    </div>';
            }
            unset($_SESSION["sign_in"]);
        }
    ?>

    <header class="m-5 p-5 border border-2 bg-light">
        <a class="text-decoration-none link-dark" href="index.php"><h1>Mi blog de videojuegos</h1></a>
        <nav class="navbar navbar-expand-sm bg-light navbar-light">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <?php //LISTADO DE CATEGORIAS
                        foreach($categorias as $id => $nombre){
                            echo '<li class="nav-item"><a class="nav-link" href=index.php?cat='. $id .'>'. $nombre .'</a></li>';
                        }
                    ?>
                </ul>
            </div>
        </nav>
    </header>

    <div class="row m-5">
        <article class="<?php echo $cuerpo ?> border border-2 bg-light">
            <?php //LISTADO DE ENTRADAS SI SE HA LOGUEADO
                if(isset($_SESSION['log_in'])){
                    if(isset($entradas)){
                        foreach($entradas as $id => $datos){
                            echo '<br><a class="text-dark text-decoration-none" href=entrada.php?id='. $id .'>
                                <div class="entrada"><h2 class="text-decoration-underline m-2">'. $datos['titulo'] .'</h2>
                                <p class="m-1">'. substr($datos['descripcion'], 0, 500) .'...</p></div></a>';
                        }
                    }else{
                        //SI NO SE HA SELECCIONADO UNA CATEGORIA MUESTRA EL MENU DE ACCION
                        echo '<a href="todas.php"><button type="button" class="mt-4 mb-2 container-fluid btn btn-success">Ver todas las Entradas</button></a>
                            <a href="forms/entrada_form.php"><button type="button" class="mt-2 mb-2 container-fluid btn btn-primary">Crear Entrada</button></a>
                            <a href="forms/categoria_form.php"><button type="button" class="mt-2 mb-2 container-fluid btn btn-primary">Crear Categoria</button></a>
                            <a href="forms/ajustes_form.php"><button type="button" class="mt-2 mb-5 container-fluid btn btn-warning">Ajustes de Usuario</button></a>';
                    }

                    if($_SESSION['log_in']){
                        echo "<br>Logeado como " . $_SESSION['log_in'];
                        echo "<br><a href=process/logout.php>Cerrar Sesion</a><br>";
                    }
                }
            ?>
        </article>


        <div class="<?php echo $espacio ?>"></div>
        <aside class="<?php echo $aside ?>">
            <div class="row border border-2 bg-light">
                <h3 class="text-center">Log In</h3>
                <form name="login" class="p-3" action="process/logeo.php" method="post">
                    <label for="correo">Correo:<br>
                        <input type="mail" name="correo" id="correo">
                    </label><br>
                    <label for="contrasenia">Contraseña:<br>
                        <input type="password" name="contrasenia" id="contrasenia">
                    </label><br>
                    <?php //ERRORES EN LOGIN FORM
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
                <form name="signin" class="p-3" action="process/registro.php" method="post">
                    <label for="nombre">Nombre:<br>
                        <input type="text" name="nombre" id="nombre">
                    </label><br>
                    <?php //ERRORES EN SIGN IN FORM
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
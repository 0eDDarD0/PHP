<?php
    /*
    ESTA PAGINA REALIZA:
        FORMULARIO DE AJUSTES DE USUARIOS
        MODIFICACION DE AJUSTES DE USUARIOS
    */

    include '../modules/utilities.php';
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //VALIDACION NOMBRE
        $nombre = limpiaChar($_REQUEST["nombre"]);
        if(preg_match('/[^a-z A-Z0]/', $nombre)){
            $_SESSION["error_nombre"] = true;
        }
        //VALIDACION APELLIDOS
        $apellidos = limpiaChar($_REQUEST["apellidos"]);
        if(preg_match('/[^a-z A-Z0]/', $apellidos)){
            $_SESSION["error_apellidos"] = true;
        }
        //VALIDACION CORREO
        $correo = limpiaChar($_REQUEST["correo"]);
        if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
            if(!empty($correo)){
                $_SESSION["error_correo"] = true;
            }
        }
        //VALIDACION CONTRASEÑA
        $contrasenia = limpiaChar($_REQUEST["contrasenia"]);
        if(preg_match('/[^a-zA-Z0-9_\-!¡?¿+*]/', $contrasenia)){
            $_SESSION["error_contrasenia"] = true;
        }

        $con = 'mysql:dbname=proyecto1;host=localhost;charset=utf8';
        try{
            $db = new PDO($con, 'fer', 'root');

            //ANTES DE ACTUALIZAR EN LA BASE DE DATOS COMPRUEBA QUE NO HAY ERRORES
            if(!isset($_SESSION["error_nombre"]) || !isset($_SESSION["error_apellidos"]) || !isset($_SESSION["error_correo"]) || !isset($_SESSION["error_contrasenia"])){
                //ACTUALIZACION DE NOMBRE
                if(!empty($nombre)){
                    $upd = $db->prepare('UPDATE usuarios set nombre=:nuevo where email=:correo');
                    $upd->bindValue(':nuevo', $nombre, PDO::PARAM_STR);
                    $upd->bindValue(':correo', $_SESSION["log_in"], PDO::PARAM_STR);
                    $upd->execute();
                    if($upd){
                        $_SESSION["ajustes_form"] = 1;
                    }else{
                        $_SESSION["error_sql"] = 1;
                    }
                }

                //ACTUALIZACION DE APELLIDOS
                if(!empty($apellidos)){
                    $upd = $db->prepare('UPDATE usuarios set apellidos=:nuevo where email=:correo');
                    $upd->bindValue(':nuevo', $apellidos, PDO::PARAM_STR);
                    $upd->bindValue(':correo', $_SESSION["log_in"], PDO::PARAM_STR);
                    $upd->execute();
                    if($upd){
                        $_SESSION["ajustes_form"] = 1;
                    }else{
                        $_SESSION["error_sql"] = 1;
                    }
                }

                //ACTUALIZACION DE CONTRASEÑA
                if(!empty($contrasenia)){
                    $contrasenia = password_hash($contrasenia, PASSWORD_BCRYPT, ['cost'=>4]);
                    $upd = $db->prepare('UPDATE usuarios set password=:nuevo where email=:correo');
                    $upd->bindValue(':nuevo', $contrasenia, PDO::PARAM_STR);
                    $upd->bindValue(':correo', $_SESSION["log_in"], PDO::PARAM_STR);
                    $upd->execute();
                    if($upd){
                        $_SESSION["ajustes_form"] = 1;
                    }else{
                        $_SESSION["error_sql"] = 1;
                    }
                }


                //ACTUALIZACION DE CORREO
                if(!empty($correo)){
                    //COMPRUEBA QUE EXISTA EL CORREO
                    $select = $db->prepare('SELECT password FROM usuarios where email=:correo');
                    $select->bindValue(':correo', $correo);
                    $select->execute();
                    //SI SE DEVUELVE UNA LINEA EXISTE UNA CUENTA CON ESE CORREO
                    if($select->rowCount() == 0){
                        //SI NO EXISTE EL NUEVO CORREO SE ACTUALIZA
                        $upd = $db->prepare('UPDATE usuarios set email=:nuevo where email=:viejo');
                        $upd->bindValue(':nuevo', $correo, PDO::PARAM_STR);
                        $upd->bindValue(':viejo', $_SESSION["log_in"], PDO::PARAM_STR);
                        $upd->execute();
                        if($upd){
                            $_SESSION["ajustes_form"] = 1;
                            $_SESSION["log_in"] = $correo;
                        }else{
                            $_SESSION["error_sql"] = 1;
                        }
                    }else{
                        //YA EXISTE ESE CORREO
                        $_SESSION["correo_existe"] = 1;
                    }
                }
            }
                
            //PARTE DE BORRADO DE CONEXION Y CATCH  
            $db = NULL;
            unset($db);
        }catch(PDOException $e){
            //ERROR EN LA CONEXION
            $_SESSION["error_sql"] = 1;
            echo $e->getMessage();
        }              
    }


    //CARGAMOS TODAS LAS CATEGORIAS
    $categorias = getCategorias('mysql:dbname=proyecto1;host=localhost;charset=utf8');

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
</head>

<!---------------------------------------------------PAGINA--------------------------------------------------->
<body class="bg-secondary">

    <!--MENSAJE DE EXITO EN LA ACTUALIZACION-->
    <?php
        if(isset($_SESSION['ajustes_form'])){
            if($_SESSION['ajustes_form']){
                echo '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Datos actualizados correctamente</strong>
                    </div>';
            }
            unset($_SESSION["ajustes_form"]);
        }
    ?>

    <!----------------------------------CABECERA---------------------------------->
    <header class="m-5 p-5 border border-2 bg-light">
        <a class="text-decoration-none link-dark" href="index.php"><h1>Mi blog de videojuegos</h1></a>
        <div class="row">
            <!-------NAV------->
            <nav class="col navbar navbar-expand-sm bg-light navbar-light">
                <div class="container-fluid">
                    <ul class="navbar-nav">
                        <!--MAQUETAMOS LAS CATEGORIAS EN EL NAV-->
                        <?php 
                            foreach($categorias as $id => $nombre){
                                echo '<li class="nav-item"><a class="nav-link" href=index.php?cat='. $id .'>'. $nombre .'</a></li>';
                            }
                        ?>
                    </ul>
                </div>
            </nav>

            <!-------BARRA DE BUSQUEDA------->
            <form method="post" action="../search.php" class="col d-flex" style="justify-content: right; align-items:center;">
                <input style="height: fit-content;" type="text" placeholder="Buscar entrada..." name="search">
                <input style="height: fit-content;" type="submit" value="Buscar">
            </form>
        </div>
    </header>

    <div class="row m-5">
        <article class="col border border-2 bg-light">
            <h1 class="m-2">Ajustes de usuario</h1>

            <?php //MENSAJE DE ERROR EN CASO DE ERROR CON LA BASE DE DATOS
                if(isset($_SESSION["error_sql"])){
                    if($_SESSION["error_sql"]){
                        echo '<p style="color:red;">Ha ocurrido un error, por favor inténtelo de nuevo</p>';
                    }
                    unset($_SESSION["error_sql"]);
                }
            ?>

                <!----------FORMULARIO DE AJUSTES DE USUSARIO---------->
                <form name="ajustes_form" class="p-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                    <!--NOMBRE-->
                    <label for="nombre">Nombre:<br>
                        <input type="text" name="nombre" id="nombre">
                    </label><br>
                    <!--ERROR NOMBRE-->
                    <?php
                        if(isset($_SESSION["error_nombre"])){
                            if($_SESSION["error_nombre"]){
                                echo '<p style="color:red;">Error en el nombre</p>';
                            }
                            unset($_SESSION["error_nombre"]);
                        }
                    ?>
                    
                    <!--APELLIDOS-->
                    <label for="apellidos">Apellidos:<br>
                        <input type="text" name="apellidos" id="apellidos">
                    </label><br>
                    <!--ERROR APELLIDOS-->
                    <?php
                        if(isset($_SESSION["error_apellidos"])){
                            if($_SESSION["error_apellidos"]){
                                echo '<p style="color:red;">Error en los apellidos</p>';
                            }
                            unset($_SESSION["error_apellidos"]);
                        }
                    ?>

                    <!--CORREO-->
                    <label for="correo">Correo:<br>
                        <input type="mail" name="correo" id="correo">
                    </label><br>
                    <!--ERROR CORREO-->
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

                    <!--CONTRASEÑA-->
                    <label for="contrasenia">Contraseña:<br>
                        <input type="password" name="contrasenia" id="contrasenia">
                    </label><br>
                    <!--ERROR CONTRASEÑA-->
                    <?php
                        if(isset($_SESSION["error_contrasenia"])){
                            if($_SESSION["error_contrasenia"]){
                                echo '<p style="color:red;">Introduzca una contraseña válida</p>';
                            }
                            unset($_SESSION["error_contrasenia"]);
                        }

                    ?>

                    <br><input type="submit" value="Enviar">
                </form>
        </article>
    </div>
</body>
</html>
<?php
    include '../modules/utilities.php';
    $con = 'mysql:dbname=proyecto1;host=localhost;charset=utf8';
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //CORREO USUARIO
        $usuario = $_SESSION["log_in"];
        //ID CATEGORIA
        $categoria = $_REQUEST["categoria"][0];
        //VALIDACION TITULO
        $titulo = limpiaChar($_REQUEST["titulo"]);
        if(empty($titulo)){
            $_SESSION["error_titulo"] = true;
        }
        //VALIDACION DESCRIPCION
        $descripcion = limpiaChar($_REQUEST["descripcion"]);
        if(empty($descripcion)){
            $_SESSION["error_descripcion"] = true;
        }


        if(@!$_SESSION["error_descripcion"] || @!$_SESSION["error_titulo"]){
            try{
                $db = new PDO($con, 'fer', 'root');

                //COMPROBAMOS SI ESTAMOS MODIFICANDO O INSERTANDO UNA ENTRADA
                if(isset($_GET['mod'])){
                    $upd = $db->prepare('UPDATE entradas set categoria_id=:categoria, titulo=:titulo, descripcion=:descripcion where id=:id');
                    $upd->bindParam(':id', $_GET['mod'], PDO::PARAM_STR);
                    $upd->bindParam(':categoria', $categoria, PDO::PARAM_STR);
                    $upd->bindParam(':titulo', $titulo, PDO::PARAM_STR);
                    $upd->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
                    $upd->execute();
                    if(!$upd){
                        //ERROR EN LA ACTUALIZACION
                        $_SESSION["error_sql"] = 1;
                    }else{
                        header('Location: ../entrada.php?id=' . $_GET['mod']);
                    }
                }else{
                    //OBTENCION DE LA ID DE USUARIO
                    $sel = $db->prepare("SELECT id FROM usuarios where email=:correo");
                    $sel->bindValue(':correo', $usuario, PDO::PARAM_STR);
                    $sel->execute();
                    $id = $sel->fetch()['id'];
                    if(!$sel){
                        //ERROR EN LA SELECCION
                        $_SESSION["error_sql"] = 1;
                    }


                    //INSERCION DE LA ENTRADA
                    $ins = $db->prepare("INSERT into entradas VALUES(null, :usuario, :categoria, :titulo, :descripcion, CURRENT_TIMESTAMP())");
                    $ins->bindValue(':usuario', $id);
                    $ins->bindValue(':categoria', $categoria, PDO::PARAM_INT);
                    $ins->bindValue(':titulo', $titulo, PDO::PARAM_STR);
                    $ins->bindValue(':descripcion', $descripcion, PDO::PARAM_STR);
                    $ins->execute();
                    if(!$ins){
                        //ERROR EN LA INSERCION
                        $_SESSION["error_sql"] = 1;
                    }else{
                        $_SESSION["new_entrada"] = 1;
                    }
                }

            
                $db = NULL;
                unset($db);
            }catch(PDOException $e){
                //ERROR EN LA CONEXION
                $_SESSION["error_sql"] = 1;
                echo $e->getMessage();
            }
        }        
    }


    //CARGAMOS LAS CATEGORIAS DEL NAV
    $con = 'mysql:dbname=proyecto1;host=localhost;charset=utf8';
    try{
        $db = new PDO($con, 'fer', 'root');

        //CARGAMOS TODAS LAS CATEGORIAS
        $categorias = getCategorias($db);

        //SI ESTAMOS ALTERANDO UNA ENTRADA RECOGEMOS SUS DATOS
        if(isset($_GET['id'])){
            if($_GET['id']){
                $sel = $db->prepare("SELECT * FROM entradas where id=:id");
                $sel->bindValue(':id', $_GET['id']);
                $sel->execute();
                $modificar = $sel->fetch();
                if(!$sel){
                    //ERROR EN LA SELECCION
                    $_SESSION["error_sql"] = 1;
                }
            }
        }

        $db = NULL;
        unset($db);
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
</head>
<body class="bg-secondary">
    <?php //MENSAJE DE EXITO DE NUEVA ENTRADA
        if(isset($_SESSION['new_entrada'])){
            if($_SESSION['new_entrada']){
                echo '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Entrada creada con éxito!</strong>
                    </div>';
            }
            unset($_SESSION["new_entrada"]);
        }
    ?>

    <header class="m-5 p-5 border border-2 bg-light">
        <a class="text-decoration-none link-dark" href="../index.php"><h1>Mi blog de videojuegos</h1></a>
        <nav class="navbar navbar-expand-sm bg-light navbar-light">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <?php //LISTADO DE CATEGORIAS
                        foreach($categorias as $id => $nombre){
                            echo '<li class="nav-item"><a class="nav-link" href=../index.php?cat='. $id .'>'. $nombre .'</a></li>';
                        }
                    ?>
                </ul>
            </div>
        </nav>
    </header>

    <div class="row m-5">
        <article class="col border border-2 bg-light">
            <h1 class="m-2">Nueva Entrada</h1>

            <?php //MENSAJE DE ERROR EN CASO DE ERROR CON LA BASE DE DATOS
                if(isset($_SESSION["error_sql"])){
                    if($_SESSION["error_sql"]){
                        echo '<p style="color:red;">Ha ocurrido un error, por favor inténtelo de nuevo</p>';
                    }
                    unset($_SESSION["error_sql"]);
                }
            ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . isset($modificar) ? "?mod=".$modificar['id'] : "" ?>" name="new_entrada" class="m-2">
                <label class="form-label" for="categoria">Categoria:<br>
                    <select name="categoria[]" id="categoria">
                        <?php //LISTADO DE CATEGORIAS
                            foreach($categorias as $id => $nombre){
                                echo '<option value="'. $id .'">'. $nombre .'</option>';
                            }
                        ?>
                    </select>
                </label><br>

                <label class="form-label" for="titulo">Titulo:<br>
                    <input type="text" name="titulo" class="form-control" value="<?php echo isset($modificar) ? $modificar['titulo'] : "" ?>">
                </label><br>
                <?php //ERROR EN EL TITULO
                    if(isset($_SESSION["error_titulo"])){
                        if($_SESSION["error_titulo"]){
                            echo '<p style="color:red;">Por favor, introduzca un título válido</p>';
                        }
                        unset($_SESSION["error_titulo"]);
                    }
                ?>

                <label for="descripcion">Cuerpo:<br>
                    <textarea style="resize: none;" rows="20" cols="170" class="fuid form-control" name="descripcion"><?php echo isset($modificar) ? $modificar['descripcion'] : "" ?></textarea>
                </label>
                <?php //ERROR EN EL TITULO
                    if(isset($_SESSION["error_descripcion"])){
                        if($_SESSION["error_descripcion"]){
                            echo '<p style="color:red;">Por favor, introduzca un cuerpo válido</p>';
                        }
                        unset($_SESSION["error_descripcion"]);
                    }
                ?>

                <input class="mt-3" type="submit" value="Enviar">
            </form>
        </article>
    </div>
</body>
</html>
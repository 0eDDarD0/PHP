<?php
    /*
    ESTA PAGINA REALIZA:
        FORMULARIO DE NUEVA ENTRADA (GET VACIO)
        INSERCION DE ENTRADA (POST)
        FORMULARIO DE MODIFICACION DE ENTRADA (GET ID)
        MODIFICACION DE ENTRADA (POST ID, MOD)
    */

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


        //COMPRUEBA QUE NO HAYA ERRORES EN LOS CAMPOS
        if(!isset($_SESSION["error_descripcion"]) || !isset($_SESSION["error_titulo"])){
            try{
                $db = new PDO($con, 'fer', 'root');

                //COMPROBAMOS SI ESTAMOS MODIFICANDO O INSERTANDO
                if(isset($_GET['mod'])){//SI ESTAMOS MODIFICANDO UNA ENTRADA...

                    //ACTUALIZAMOS LA ENTRADA
                    $upd = $db->prepare('UPDATE entradas set categoria_id=:categoria, titulo=:titulo, descripcion=:descripcion where id=:id');
                    $upd->bindParam(':id', $_GET['id'], PDO::PARAM_STR);
                    $upd->bindParam(':categoria', $categoria, PDO::PARAM_STR);
                    $upd->bindParam(':titulo', $titulo, PDO::PARAM_STR);
                    $upd->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
                    $upd->execute();
                    if($upd){
                        header('Location: ../entrada.php?id=' . $_GET['id']);
                    }else{
                        //ERROR EN LA ACTUALIZACION
                        $_SESSION["error_sql"] = 1;                        
                    }
                }else{//SI ESTAMOS INSERTANDO...

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

    //RECOGEMOS LAS CATEGORIAS DEL NAV
    $categorias = getCategorias('mysql:dbname=proyecto1;host=localhost;charset=utf8');

    //SI VAMOS A MODIFICAR UNA ENTRADA RECOGEMOS LOS DATOS PARA LLENAR LOS CAMPOS
    try{
        $db = new PDO($con, 'fer', 'root');

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
        //ERROR EN LA CONEXION
        $_SESSION["error_sql"] = 1;
        echo $e->getMessage();
    }

?>


    <!--MENSAJE DE EXITO EN LA NUEVA ENTRADA-->
    <?php
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

    <!--------------------------HEAD-------------------------------->
    <?php require_once "../modules/head.php" ?>

    <!----------------------------------CABECERA---------------------------------->
    <header class="p-3 bg-dark">
        <a class="text-decoration-none link-light" href="../index.php"><h1>Mi blog de videojuegos</h1></a>
        <div class="row">
            <!-------NAV------->
            <nav class="col navbar navbar-expand-sm bg-dark navbar-dark">
                <div class="container-fluid">
                    <ul class="navbar-nav">
                        <!--MAQUETAMOS LAS CATEGORIAS EN EL NAV-->
                        <?php
                            foreach($categorias as $id => $nombre){
                                echo '<li class="nav-item"><a class="nav-link" href=../index.php?cat='. $id .'>'. $nombre .'</a></li>';
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

    <!--------------------------CUERPO DE LA PAGINA-------------------------------->
    <div class="row m-5">
        <article class="col bg-dark text-white" style="min-height:369px">
            <h1 class="m-2">Nueva Entrada</h1>
            <!--MENSAJE DE ERROR CON LA BASE DE DATOS-->
            <?php
                if(isset($_SESSION["error_sql"])){
                    if($_SESSION["error_sql"]){
                        echo '<p style="color:red;">Ha ocurrido un error, por favor inténtelo de nuevo</p>';
                    }
                    unset($_SESSION["error_sql"]);
                }
            ?>

            <!----------FORMULARIO DE ENTRADA---------->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . (isset($modificar) ? "?id=".$modificar['id']."&mod=1" : "") ?>" name="new_entrada" class="m-2">
                <!--SELECT DE CATEGORIAS-->
                <label class="form-label" for="categoria">Categoria:<br>
                    <select name="categoria[]" id="categoria">
                        <?php 
                            foreach($categorias as $id => $nombre){
                                echo '<option value="'. $id .'">'. $nombre .'</option>';
                            }
                        ?>
                    </select>
                </label><br>

                <!--TITULO-->
                <label class="form-label" for="titulo">Titulo:<br>
                    <input type="text" name="titulo" class="form-control" value="<?php echo isset($modificar) ? $modificar['titulo'] : "" ?>">
                </label><br>
                <!--ERROR EN EL TITULO-->
                <?php
                    if(isset($_SESSION["error_titulo"])){
                        if($_SESSION["error_titulo"]){
                            echo '<p style="color:red;">Por favor, introduzca un título válido</p>';
                        }
                        unset($_SESSION["error_titulo"]);
                    }
                ?>

                <!--CUERPO DE LA ENTRADA-->
                <label for="descripcion">Cuerpo:<br>
                    <textarea style="resize: none;" rows="20" cols="170" class="fuid form-control" name="descripcion"><?php echo isset($modificar) ? $modificar['descripcion'] : "" ?></textarea>
                </label>
                <!--ERROR EN EL CUERPO DE LA ENTRADA-->
                <?php
                    if(isset($_SESSION["error_descripcion"])){
                        if($_SESSION["error_descripcion"]){
                            echo '<p style="color:red;">Por favor, introduzca un cuerpo válido</p>';
                        }
                        unset($_SESSION["error_descripcion"]);
                    }
                ?>

                <!--SUBMIT-->
                <input class="mt-3" type="submit" value="Enviar">
            </form>
        </article>
    </div>

    <!--------------------------PIE-------------------------------->
    <?php require_once "../modules/pie.php" ?>

</body>
</html>
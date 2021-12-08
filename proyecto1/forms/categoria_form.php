<?php
    /*
    ESTA PAGINA REALIZA:
        FORMULARIO DE NUEVA CATEGORIA
        INSERCION DE CATEGORIA
    */

    include '../modules/utilities.php';
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        //VALIDACION NOMBRE
        $nombre = limpiaChar($_REQUEST["nombre"]);
        if(empty($nombre)){
            $_SESSION["error_nombre"] = true;
        }

        
        $con = 'mysql:dbname=proyecto1;host=localhost;charset=utf8';
        try{
            $db = new PDO($con, 'fer', 'root');

            //INSERCION DE LA CATEGORIA
            $ins = $db->prepare("INSERT into categorias VALUES(null, :nombre)");
            $ins->bindValue(':nombre', $nombre, PDO::PARAM_STR);
            $ins->execute();
            if(!$ins){
                //ERROR EN LA INSERCION
                $_SESSION["error_sql"] = 1;
            }else{
                header('Location: ../index.php');
            }
        
            $db = NULL;
            unset($db);
        }catch(PDOException $e){
            //ERROR EN LA CONEXION
            $_SESSION["error_sql"] = 1;
            echo $e->getMessage();
        }
        
    }

    
    //CARGAMOS LAS CATEGORIAS DEL NAV
    $categorias = getCategorias('mysql:dbname=proyecto1;host=localhost;charset=utf8');

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
            <h1 class="m-2">Nueva Categoria</h1>

            <!--ERROR CON LA BASE DE DATOS-->
            <?php
                if(isset($_SESSION["error_sql"])){
                    if($_SESSION["error_sql"]){
                        echo '<p style="color:red;">Ha ocurrido un error, por favor inténtelo de nuevo</p>';
                    }
                    unset($_SESSION["error_sql"]);
                }
            ?>

            <!----------FORMULARIO DE CATEGORIA---------->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" name="new_categoria" class="m-2">
                <!--NOMBRE-->
                <label class="form-label" for="nombre">Nombre de la categoría:<br>
                    <input type="text" name="nombre" class="form-control">
                </label><br>
                <!--ERROR EN EL NOMBRE-->
                <?php
                    if(isset($_SESSION["error_nombre"])){
                        if($_SESSION["error_nombre"]){
                            echo '<p style="color:red;">Por favor, introduzca un nombre válido</p>';
                        }
                        unset($_SESSION["error_nombre"]);
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
<?php
    /*
    ESTA PAGINA REALIZA:
        MAQUETACION DE UNA ENTRADA COMPLETA
        MAQUETACION DE BOTONES DE EDICION PARA USUARIOS LOGEADOS
    */

    include './modules/utilities.php';
    session_start();

    $con = 'mysql:dbname=proyecto1;host=localhost;charset=utf8';
    try{
        $db = new PDO($con, 'fer', 'root');
        //BORRAMOS LA ENTRADA SI SE HA PEDIDO
        if(isset($_GET["rm"])){
            if($_GET["rm"]){
                $del = $db->prepare('DELETE from entradas where id=:id');
                $del->bindValue(':id', $_GET["id"]);
                $del->execute();
                if($del){
                    header('Location: index.php');
                }else{
                    $_SESSION["error_sql"] = 1;
                }
            }
        }


        //OBTENEMOS LA ID DEL USUARIO LOGUEADO
        if(isset($_SESSION["log_in"])){
            if($_SESSION["log_in"]){
                $sel = $db->prepare('SELECT id from usuarios where email=:correo');
                $sel->bindValue(':correo', $_SESSION['log_in'], PDO::PARAM_STR);
                $sel->execute();
                $usuario = $sel->fetch(PDO::FETCH_ASSOC)['id'];
            }
        }


        $db = NULL;
        unset($db);
    }catch(PDOException $e){
        echo 'Error al conectar con la base de datos ' . $e->getMessage();
    }


    //CARGAMOS TODAS LAS CATEGORIAS DEL NAV
    $categorias = getCategorias('mysql:dbname=proyecto1;host=localhost;charset=utf8');
    //CARGAMOS LA ENTRADA QUE SE HA PEDIDO POR GET SEGUN SU ID
    $entradas = getEntradas('mysql:dbname=proyecto1;host=localhost;charset=utf8', -1);
    $ent = $entradas[$_GET['id']];

?>

    <!--------------------------HEAD-------------------------------->
    <?php require_once "./modules/head.php" ?>

    <!--MENSAJE DE ERROR EN LA BASE DE DATOS-->
    <?php
        if(isset($_SESSION["error_sql"])){
            if($_SESSION["error_sql"]){
                echo '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Error al borrar el post, por favor, intentelo de nuevo en unos minutos</strong>
                        </div>';            }
            unset($_SESSION["error_sql"]);
        }
    ?>

    <!----------------------------------CABECERA---------------------------------->
    <header class="p-3 bg-dark">
        <a class="text-decoration-none link-light" href="index.php"><h1>Mi blog de videojuegos</h1></a>
        <div class="row">
            <!-------NAV------->
            <nav class="col navbar navbar-expand-sm bg-dark navbar-dark">
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
            <form method="post" action="search.php" class="col d-flex" style="justify-content: right; align-items:center;">
                <input style="height: fit-content;" type="text" placeholder="Buscar entrada..." name="search">
                <input style="height: fit-content;" type="submit" value="Buscar">
            </form>
        </div>
    </header>

    <!--------------------------CUERPO DE LA PAGINA-------------------------------->
    <div class="row m-5">
        <article class="col bg-dark text-white p-4" style="min-height:369px">
            <?php
                //MAQUETAMOS LA ENTRADA SELECCIONADA
                echo '<h2 class="text-decoration-underline m-3 mt-4">'. $ent['titulo'] .'</h2>
                <p class="m-3 mb-4">'. $ent['descripcion'] .'</p>';

                //SI EL USUARIO LOGUEADO ES EL AUTOR DE LA ENTRADA MAQUETA LOS BOTONES DE EDICION
                if($usuario == $ent['usuario']){
                    echo '<a href="forms/entrada_form.php?id='. $_GET['id'] .'" class="btn btn-warning m-3">Editar Entrada</a>
                        <a href="entrada.php?id='. $_GET['id'] .'&rm=1" class="btn btn-danger m-3">Borrar Entrada</a>';
                }
            ?>
        </article>
    </div>

    <!--------------------------PIE-------------------------------->
    <?php require_once "./modules/pie.php" ?>

</body>
</html>
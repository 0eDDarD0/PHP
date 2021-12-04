<?php
    /*
    ESTA PAGINA REALIZA:
        MAQUETACION DE UNA ENTRADA COMPLETA
        MAQUETACION DE BOTONES DE EDICION PARA USUARIOS LOGEADOS
    */

    include './modules/utilities.php';
    session_start();

    //CARGAMOS CONTENIDOS
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
            <form method="post" action="./search.php" class="col d-flex" style="justify-content: right; align-items:center;">
                <input style="height: fit-content;" type="text" placeholder="Buscar entrada..." name="search">
                <input style="height: fit-content;" type="submit" value="Buscar">
            </form>
        </div>
    </header>

    <!--------------------------CUERPO DE LA PAGINA-------------------------------->
    <div class="row m-5">
        <article class="col border border-2 bg-light">
            <?php
                //MAQUETAMOS LA ENTRADA SELECCIONADA
                echo '<h2 class="text-decoration-underline m-3 mt-4">'. $ent['titulo'] .'</h2>
                <p class="m-3 mb-4">'. $ent['descripcion'] .'</p>';

                //SI EL USUARIO LOGUEADO ES EL AUTOR DE LA ENTRADA MAQUETA LOS BOTONES DE EDICION
                if($usuario == $ent['usuario']){
                    echo '<a href="forms/entrada_form.php?id='. $_GET['id'] .'" class="btn btn-warning mb-4">Editar Entrada</a>
                        <a href="entrada.php?id='. $_GET['id'] .'&rm=1" class="btn btn-danger mb-4">Borrar Entrada</a>';
                }
            ?>
        </article>
    </div>
</body>
</html>
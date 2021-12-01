<?php
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
                header('Location: index.php');
            }
        }

        //CARGAMOS LAS ENTRADAS
        $entradas = getEntradas($db, -1);
        $ent = $entradas[$_GET['id']];


        //OBTENEMOS LA ID DEL USUARIO LOGUEADO
        if(isset($_SESSION["log_in"])){
            if($_SESSION["log_in"]){
                $sel = $db->prepare('SELECT id from usuarios where email=:correo');
                $sel->bindValue(':correo', $_SESSION['log_in'], PDO::PARAM_STR);
                $sel->execute();
                $usuario = $sel->fetch(PDO::FETCH_ASSOC)['id'];
            }
        }


        //CARGAMOS TODAS LAS CATEGORIAS DEL NAV
        $categorias = getCategorias($db);

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
        <article class="col border border-2 bg-light">
            <?php
                echo '<h2 class="text-decoration-underline m-3 mt-4">'. $ent['titulo'] .'</h2>
                <p class="m-3 mb-4">'. $ent['descripcion'] .'</p>';

                if($usuario == $ent['usuario']){
                    echo '<a href="forms/entrada_form.php?id='. $_GET['id'] .'" class="btn btn-warning mb-4">Editar Entrada</a>
                        <a href="entrada.php?id='. $_GET['id'] .'&rm=1" class="btn btn-danger mb-4">Borrar Entrada</a>';
                }
            ?>
        </article>
    </div>
</body>
</html>
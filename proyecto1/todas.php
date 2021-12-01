<?php
    include './modules/utilities.php';
    session_start();

    //ELEMENTOS A CARGAR EN LA PAGINA
    $con = 'mysql:dbname=proyecto1;host=localhost;charset=utf8';
    try{
        $db = new PDO($con, 'fer', 'root');

        //CARGAMOS TODAS LAS CATEGORIAS
        $categorias = getCategorias($db);
        
        //CARGAMOS TODAS LAS ENTRADAS
        $entradas = getEntradas($db, -1); //pasamos -1 para que cargue sin tener en cuenta la categoria


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
    <link href="./styles/entrada.css" rel="stylesheet">
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
            <?php //LISTADO DE ENTRADAS SI SE HA LOGUEADO
                if(isset($_SESSION['log_in'])){
                    if(isset($entradas)){
                        foreach($entradas as $id => $datos){
                            echo '<br><a class="text-dark text-decoration-none" href=entrada.php?id='. $id .'>
                                <div class="entrada"><h2 class="text-decoration-underline m-2">'. $datos['titulo'] .'</h2>
                                <p class="m-1">'. substr($datos['descripcion'], 0, 500) .'...</p></div></a>';
                        }
                    }
                }
            ?>
        </article>
    </div>

</body>
</html>
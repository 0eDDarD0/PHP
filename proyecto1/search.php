<?php
    include './modules/utilities.php';
    session_start();

    //CARGAMOS TODAS LAS CATEGORIAS
    $categorias = getCategorias('mysql:dbname=proyecto1;host=localhost;charset=utf8');

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //RECOGEMOS TODAS LAS ENTRADAS
        $entradas = getEntradas('mysql:dbname=proyecto1;host=localhost;charset=utf8', -1);
        //PASAMOS LA BUSQUEDA A MINUSCULA
        $search = strtolower($_REQUEST["search"]);

        $resultados = [];
        foreach($entradas as $id => $datos){
            //COMPROBAMOS QUE LA PALABRA ESTE EN EL TITULO
            if(strpos(strtolower($datos['titulo']), $search) !== false){
                $resultados[$id] = $datos;
            }
        }
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

<!---------------------------------------------------PAGINA--------------------------------------------------->
<body class="bg-secondary">

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
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="col d-flex" style="justify-content: right; align-items:center;">
                <input style="height: fit-content;" type="text" placeholder="Buscar entrada..." name="search">
                <input style="height: fit-content;" type="submit" value="Buscar">
            </form>
        </div>
    </header>

    <!--------------------------CUERPO DE LA PAGINA-------------------------------->
    <div class="row m-5">
        <article class="<?php echo $cuerpo ?> border border-2 bg-light">
            <?php 
                foreach($resultados as $id => $datos){
                    echo '<br><a class="text-dark text-decoration-none" href=entrada.php?id='. $id .'>
                        <div class="entrada"><h2 class="text-decoration-underline m-2">'. $datos['titulo'] .'</h2>
                        <p class="m-1">'. substr($datos['descripcion'], 0, 500) .'...</p></div></a>';
                }
            ?>
        </article>
    </div>
</body>
</html>
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

    <!--------------------------HEAD-------------------------------->
    <?php require_once "./modules/head.php" ?>

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
        <article class="<?php echo $cuerpo ?> bg-dark p-4 text-white"  style="min-height:369px">
            <?php
                //SI SE HAN ENCONTRADO RESULTADOS LOS IMPRIME
                if(count($resultados)){
                    foreach($resultados as $id => $datos){
                        echo '<br><a class="text-white text-decoration-none" href=entrada.php?id='. $id .'>
                            <div class="entrada"><h2 class="text-decoration-underline m-2">'. $datos['titulo'] .'</h2>
                            <p class="m-1">'. substr($datos['descripcion'], 0, 500) .'...</p></div></a>';
                    }
                }else{
                    //SI NO SE HAN ENCONTRADO RESULTADOS IMPRIME UN MENSAJE QUE LO INDIQUE
                    echo "No se ha encontrado ningun resultado";
                }
            ?>
        </article>
    </div>

<!--------------------------------PIE-------------------------------->
<?php require_once "./modules/pie.php" ?>

</body>
</html>
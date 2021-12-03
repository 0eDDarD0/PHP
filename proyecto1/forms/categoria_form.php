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
                header('Location: index.php');
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

    <!----------------------------------CABECERA---------------------------------->
    <header class="m-5 p-5 border border-2 bg-light">
        <a class="text-decoration-none link-dark" href="index.php"><h1>Mi blog de videojuegos</h1></a>
        <nav class="navbar navbar-expand-sm bg-light navbar-light">
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
    </header>

    <!--------------------------CUERPO DE LA PAGINA-------------------------------->
    <div class="row m-5">
        <article class="col border border-2 bg-light">
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

            <!----------FORMULARIO DE LOG IN---------->
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
</body>
</html>
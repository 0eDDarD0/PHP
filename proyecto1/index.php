<?php
    /*
    ESTA PAGINA REALIZA:
        FORMULARIO DE LOGIN Y SIGNIN
        MENU DE USUARIOS
        MAQUETACION DE ENTRADAS POR CATEGORIA
        MAQUETACION DE TODAS LAS ENTRADAS
    */

    include './modules/utilities.php';
    session_start();

    //ELEMENTOS A CARGAR SEGUN SI HAY LOGEO
    if(isset($_SESSION['log_in'])){
        if($_SESSION['log_in']){
            $cuerpo = "col-12";
            $espacio = "d-none";
            $aside = "d-none";
        }else{
            $cuerpo = "col-8";
            $espacio = "col-1";
            $aside = "col-3";
        }
    }else{
        $cuerpo = "col-8";
        $espacio = "col-1";
        $aside = "col-3";
    }

    //CARGAMOS TODAS LAS CATEGORIAS
    $categorias = getCategorias('mysql:dbname=proyecto1;host=localhost;charset=utf8');

    //ENTRADAS A CARGAR SI SE HA ENTRADO EN ALGUNA CATEGORIA
    if(isset($_GET['cat'])){
        if($_GET['cat']){
            $entradas = getEntradas('mysql:dbname=proyecto1;host=localhost;charset=utf8', $_GET['cat']);
            $_GET['cat'] = 0;
        }
    }

?>


    <!--MENSAJE DE EXITO EN EL REGISTRO-->
    <?php
        if(isset($_SESSION['sign_in'])){
            if($_SESSION['sign_in']){
                echo '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Usuario registrado con exito!</strong>
                    </div>';
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
            <?php
                if(isset($_SESSION['log_in'])){
                    echo '<form method="post" action="search.php" class="col d-flex" style="justify-content: right; align-items:center;">
                        <input style="height: fit-content;" type="text" placeholder="Buscar entrada..." name="search">
                        <input style="height: fit-content;" type="submit" value="Buscar"></form>';
                }
            ?>
        </div>
    </header>

    <!--------------------------CUERPO DE LA PAGINA-------------------------------->
    <div class="row m-5">
        <article class="<?php echo $cuerpo ?> p-4 bg-dark text-white" style="min-height:369px">

            <!----------COMPROBAMOS SI HAY LOGIN---------->
            <?php 
                if(isset($_SESSION['log_in'])){
                    if(isset($entradas)){
                        foreach($entradas as $id => $datos){
                            //SI SE HA SELECCIONADO UNA CATEGORIA MUESTRA LAS ENTRADAS
                            echo '<br><a class="text-white text-decoration-none" href=entrada.php?id='. $id .'>
                                <div class="entrada"><h2 class="text-decoration-underline m-2">'. $datos['titulo'] .'</h2>
                                <p class="m-1">'. substr($datos['descripcion'], 0, 500) .'...</p></div></a>';
                        }
                    }else{
                        //SI NO SE HA SELECCIONADO UNA CATEGORIA MUESTRA EL MENU DE USUARIO
                        echo '<a href="index.php?cat=-1"><button type="button" class="mt-4 mb-2 container-fluid btn btn-success">Ver todas las Entradas</button></a>
                            <a href="forms/entrada_form.php"><button type="button" class="mt-2 mb-2 container-fluid btn btn-primary">Crear Entrada</button></a>
                            <a href="forms/categoria_form.php"><button type="button" class="mt-2 mb-2 container-fluid btn btn-primary">Crear Categoria</button></a>
                            <a href="forms/ajustes_form.php"><button type="button" class="mt-2 mb-5 container-fluid btn btn-warning">Ajustes de Usuario</button></a>';
                        echo "<br>Logeado como " . $_SESSION['log_in'];
                        echo "<br><a href=process/logout.php>Cerrar Sesion</a><br>";
                        }
                }else{
                    //SI NO HAY LOGIN SE MUESTRA UN MENSAJE
                    echo "<h2>Logueate para leer y compartir tus posts con nuestra comunidad!!!</h2>";
                }
            ?>
        </article>


        <!----------------------------------ASIDE (SOLO SI NO HAY LOGIN)---------------------------------->
        <div class="<?php echo $espacio ?>"></div>
        <aside class="<?php echo $aside ?>">
            <!----------FORMULARIO DE LOG IN---------->
            <div class="row bg-dark text-white">
                <h3 class="text-center">Log In</h3>
                <form name="login" class="p-3" action="process/logeo.php" method="post">
                    <!--CORREO-->
                    <label for="correo">Correo:<br>
                        <input type="mail" name="correo" id="correo">
                    </label><br>
                    <!--CONTRASEÑA-->
                    <label for="contrasenia">Contraseña:<br>
                        <input type="password" name="contrasenia" id="contrasenia">
                    </label><br>
                    <!--ERRORES DE LOGIN-->
                    <?php
                        if(isset($_SESSION["error_credenciales"])){
                            if($_SESSION["error_credenciales"]){
                                echo '<p style="color:red;">Las credenciales no son correctas</p>';
                            }
                            unset($_SESSION["error_credenciales"]);

                        }else if(isset($_SESSION["correo_no_registrado"])){
                            if($_SESSION["correo_no_registrado"]){
                                echo '<p style="color:red;">No existe un usuario con ese correo</p>';
                            }
                            unset($_SESSION["correo_no_registrado"]);
                        }
                    ?>
                    <!--SUBMIT-->
                    <br><input type="submit" value="Log in">
                </form>
            </div>

            <div class="row p-3"></div><!----------ESPACIO LIBRE---------->

            <!----------FORMULARIO DE SIGN IN---------->
            <div class="row bg-dark text-white">
                <h3 class="text-center">Sign In</h3>
                <form name="signin" class="p-3" action="process/registro.php" method="post">
                    <!--NOMBRE-->
                    <label for="nombre">Nombre:<br>
                        <input type="text" name="nombre" id="nombre">
                    </label><br>
                    <!--ERROR EN EL NOMBRE-->
                    <?php
                        if(isset($_SESSION["error_nombre"])){
                            if($_SESSION["error_nombre"]){
                                echo '<p style="color:red;">Error en el nombre</p>';
                            }
                            unset($_SESSION["error_nombre"]);
                        }
                    ?>

                    <!--APELLIDOS-->
                    <label for="apellidos">Apellidos:<br>
                        <input type="text" name="apellidos" id="apellidos">
                    </label><br>
                    <!--ERROR EN LOS APELLIDOS-->
                    <?php
                        if(isset($_SESSION["error_apellidos"])){
                            if($_SESSION["error_apellidos"]){
                                echo '<p style="color:red;">Error en los apellidos</p>';
                            }
                            unset($_SESSION["error_apellidos"]);
                        }
                    ?>

                    <!--CORREO-->
                    <label for="correo">Correo:<br>
                        <input type="mail" name="correo" id="correo">
                    </label><br>
                    <!--ERROR EN EL CORREO-->
                    <?php
                        if(isset($_SESSION["error_correo"])){
                            if($_SESSION["error_correo"]){
                                echo '<p style="color:red;">Introduzca un correo válido</p>';
                            }
                            unset($_SESSION["error_correo"]);

                        }else if((isset($_SESSION["correo_existe"]))){
                            if($_SESSION["correo_existe"]){
                                echo '<p style="color:red;">ese correo ya esta en uso</p>';
                            }
                            unset($_SESSION["correo_existe"]);
                        }
                    ?>

                    <!--CONTRASEÑA-->
                    <label for="contrasenia">Contraseña:<br>
                        <input type="password" name="contrasenia" id="contrasenia">
                    </label><br>
                    <!--ERROR CONTRASEÑA-->
                    <?php
                        if(isset($_SESSION["error_contrasenia"])){
                            if($_SESSION["error_contrasenia"]){
                                echo '<p style="color:red;">Introduzca una contraseña válida (letras numeros ò _-!¡?¿+)</p>';
                            }
                            unset($_SESSION["error_contrasenia"]);
                        }

                    ?>
                    <!--SUBMIT-->
                    <br><input type="submit" value="Sign in">
                </form>
            </div>
        </aside>
    </div>

    <!--------------------------PIE-------------------------------->
    <?php require_once "./modules/pie.php" ?>

</body>
</html>
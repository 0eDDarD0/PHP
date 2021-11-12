<?php

    session_start();

    if(isset($_GET['close'])){
        if($_GET['close'] == 1){
            session_destroy();
            echo "Ha cerrado la sesion correctamente";
        }
    }else{
        if($_REQUEST["user"] == "usuario" && $_REQUEST["password"] == "1234"){
            $_SESSION["login"] = 1;
            echo " Ha iniciado sesión como: " . $_REQUEST["user"];
            echo '<br><a href="logeado.php?close=1">Cerrar sesion</a>';
        }else{
            header('Location: ej5.php?err=1');
        }
    }

?>
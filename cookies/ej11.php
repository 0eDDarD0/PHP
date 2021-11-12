<?php

    if(!isset($_COOKIE["visita"])){
        setcookie("visita", strftime("%A, %d of %B of %Y %H:%M:%S", time()), time() + 60 * 60);
        header('Location: ej11.php');
    }else{
        echo "Bienvenido, llegaste a la pagina el: " . $_COOKIE["visita"];
    }

?>
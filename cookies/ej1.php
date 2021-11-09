<?php

    //unset($_COOKIE["visitas"]);
    //setcookie("visitas", "", time() - 600);

    if(!isset($_COOKIE["visitas"])){
        echo "bienvenido por primera vez";
        setcookie("visitas", 2, time() + (60 * 60 * 24 * 365));
    }else{
        setcookie("visitas", $_COOKIE["visitas"] + 1, time() + 600);
        echo "Bienvenido por " . $_COOKIE["visitas"] . " vez";
    }

?>
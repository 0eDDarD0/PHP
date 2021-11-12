<?php
    session_start();

    for($i = 0 ; $i < $_SESSION["num"] ; $i++){ //borra todas las cookies visita
        setcookie("visitas[".$i."]", "", 1);
    }
    session_destroy();  //borra la sesion
    echo "Se cerró la sesión correctamente";
?>
<?php

    if(isset($_COOKIE['politica'])){
        echo "todo perfe";
    }else{
        echo '<script>alert("Pulsa aceptar para aceptar las cookies y entrar a la pagina")</script>';
        setcookie("politica", true, time() + 60);
    }

?>
<?php

    session_start();
    
    if(isset($_SESSION['counter'])){
        if($_GET['redirect']){
            $_SESSION['counter']++;
        }else{
            $_SESSION['counter']--;
        }
    }else{
        $_SESSION['counter'] = 0;
    }

    echo "La sesion es: " . $_SESSION['counter'];

?>
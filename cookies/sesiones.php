<?php

    session_start();

    if(isset($_SESSION['counter'])){
        $_SESSION['counter']++;
    }else{
        $_SESSION['counter'] = 1;
    }
    echo $_SESSION['counter'];

    echo "<br><a href='sesiones2.php'>link</a>";

?>
<?php
    /*
    ESTA PAGINA REALIZA:
        CIERRE DE SESION (LOGOUT)
    */

    session_start();
    unset($_SESSION['log_in']);
    header('Location: ../index.php');

?>
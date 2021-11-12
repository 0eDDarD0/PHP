<?php
    session_start();
    echo "<h1>Bienvenido a mi página</h1>";
    echo "<a href='borrado.php'>Cerrar sesion</a><br>";

    if(!isset($_COOKIE["visitas"][0])){     //Comprueba si existe la cookie, si no...
        setcookie("visitas[0]", strftime("%A, %d of %B of %Y %H:%M:%S", time()), time() + 60 * 60 * 24 * 7); // crea la primera y le agrega la fecha de la sesion
        $_SESSION["num"] = 0;   //inicializa el numero de cookies visita de la sesion
        echo "Primera visita!";
    }else{      //si la cookie ya existe...
        $_SESSION["num"]++;     //aumenta el numero de cookies visita de la sesion
        setcookie("visitas[".$_SESSION["num"]."]", strftime("%A, %d of %B of %Y %H:%M:%S", time()), time() + 60 * 10);  //añade una nueva cookie visita
        for($i = 0 ; $i < $_SESSION["num"] ; $i++){
            echo $_COOKIE["visitas"][$i] . "<br>";  //muestra todas las cookies visita guardadas
        }
    }

?>
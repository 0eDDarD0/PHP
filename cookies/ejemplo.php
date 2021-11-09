<?php

    setcookie("aymicookie", "Pepperoni", time() + 300);

    if(isset($_COOKIE["aymicookie"])){
        echo $_COOKIE["aymicookie"];
        unset($_COOKIE['aymicookie']);
        setcookie('aymicookie', '', time() - 300);
        echo "<h1>" . $_COOKIE["aymicookie"] . "</h1>";
    }else{
        echo "error en las cookies";
    }

?>
<?php

    $var1 = 100;

    //FUNCIONES UTILES
    echo var_dump($var1) . "<br>";
    echo gettype($var1) . "<br><br>";


    function imprimir(){
        global $var1; //ASI HACEMOS QUE VAR1 PERTENZCA A ESTE SCOPE
        echo $var1;
    }
    imprimir();


    //GLOBALES DEL SISTEMA
    echo "<br> ip server " . $_SERVER['SERVER_ADDR'];
    echo "<br> nombre server " . $_SERVER['SERVER_NAME'];
    echo "<br> programa DE server " . $_SERVER['SERVER_SOFTWARE'];
    echo "<br> protocolo server " . $_SERVER['SERVER_PROTOCOL'];
    echo "<br> metodo de peticion " . $_SERVER['REQUEST_METHOD'];
    echo "<br> ruta dentro de htdocs " . $_SERVER['PHP_SELF'];
    echo "<br> navegador " . $_SERVER['HTTP_USER_AGENT'];


    //CONSTANTES PREDEFINIDAS
    echo "<br><br>";
    echo PHP_OS . "<br>";
    echo PHP_VERSION . "<br>";
    echo PHP_EXTENSION_DIR . "<br>";
    echo PHP_INT_SIZE . "<br>";
    echo PHP_INT_MAX . "<br>";
    echo PHP_INT_MIN . "<br>";
    echo __LINE__ . "<br>";
    echo __DIR__ . "<br>";
    echo __FILE__ . "<br>";

?>
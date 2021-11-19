<?php

    try{
        if(!isset($_GET["n1"])){
            throw new Exception("faltan parametros por url");
        }
    }catch(Exception $e){
        echo "se produjo el error: " . $e->getMessage();
    }

    
    function manejado($errno, $str, $file, $line){
        echo $str . " in " . $file . " at line " . $line;
    }

    set_error_handler("manejado");
    $a = $b;

?>
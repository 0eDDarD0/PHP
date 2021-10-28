<?php

    /*if(empty($_GET["nombre"])){
        echo "Error, faltan parametros en la url";
    }else{
        echo "Hola " . $_GET["nombre"];
    }*/

    if(empty($_GET["n1"]) or empty($_GET["n2"])){

        echo "No se encuentra alguno de los parametros";
        return;
    }else{
        if(!is_numeric($_GET["n1"]) or !is_numeric($_GET["n2"])){
            
            echo "Los parametros deben ser numericos";
            return;
        }else{
            
            echo $_GET["n1"] + $_GET["n2"];
        }
    }
?>
<?php

    if(!isset($_GET["n1"]) or !isset($_GET["n2"]) or !isset($_GET["o"])){

        echo "No se encuentra alguno de los parametros";
        return;
    }else{
        if(!is_numeric($_GET["n1"]) or !is_numeric($_GET["n2"])){
            
            echo "Los parametros deben ser numericos";
            return;
        }else{
            if($_GET["o"] == "s")
                echo "La suma es ". $_GET["n1"] + $_GET["n2"];
            else if($_GET["o"] == "-")
                echo "La resta es ". $_GET["n1"] - $_GET["n2"];
            else if($_GET["o"] == "*")
                echo "La multiplicacion es ". $_GET["n1"] * $_GET["n2"];
            else if($_GET["o"] == "/")
                echo "La division es ". $_GET["n1"] / $_GET["n2"];
            else
                echo "El operador debe ser s - * ó /";
        }
    }
?>
<?php

    if(!isset($_GET["n1"]) or !isset($_GET["n2"])){

        echo "No se encuentra alguno de los parametros";
        return;
    }else{
        if(!is_numeric($_GET["n1"]) or !is_numeric($_GET["n2"])){
            
            echo "Los parametros deben ser numericos";
            return;
        }else{
            if($_GET["n1"] >= $_GET["n2"]){

                echo "Error el primer numero debe ser menor que el segundo";
            }else{
            
                for($i = $_GET["n1"] + 1 ; $i < $_GET["n2"] ; $i++){

                    echo $i;
                }
            }
        }
    }
?>
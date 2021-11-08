<?php

    $f = fopen("ej2.txt", 'r');
    if($f){
        while(!feof($f)){
            echo fgetc($f);
        }
    }else{
        echo "Error al abrir el fichero<br>";
    }

?>
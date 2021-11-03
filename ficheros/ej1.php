<?php

    if(fopen("ej1.txt", 'r')){
        echo "Fichero abierto correctamente<br>";
    }else{
        echo "Error al abrir el fichero<br>";
    }

    if(fopen("no_existe.txt", 'r')){
        echo "Fichero abierto correctamente<br>";
    }else{
        echo "Error al abrir el fichero<br>";
    }

?>
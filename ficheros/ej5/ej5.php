<?php

    $f = fopen("ej5.txt", 'r');
    if($f){
        echo fgets($f);
        fclose($f);
        $f = fopen("ej5.txt", 'w');
        fwrite($f, "escritura");
        fclose($f);
        copy("./ej5.txt", "./d/nuevo.txt");
        rename("ej5.txt", "nuevo.txt");
        unlink("nuevo.txt");

    }else{
        echo "Error al abrir el fichero<br>";
    }

?>
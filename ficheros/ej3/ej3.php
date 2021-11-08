<?php

    $f = fopen("ej3.txt", 'r');
    if($f){
        while(!feof($f)){
            $l = fscanf($f, "%d %d %d %d");
            echo $l[0] . " " . $l[1] . " " .$l[2] . " " .$l[3];
        }
        echo "<br>";
        rewind($f);
        $l1;
        $l2;
        $l3;
        $l4;
        while(!feof($f)){
            $l = fscanf($f, "%d %d %d %d", $l1, $l2, $l3, $l4);
            echo $l1 . " " . $l2 . " " .$l3 . " " .$l4;
        }

    }else{
        echo "Error al abrir el fichero<br>";
    }

?>
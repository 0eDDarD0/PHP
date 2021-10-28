<?php

    $nums = [2,1,7,5,8,9,4,6,3];

    //recorrer y mostrar
    for($i = 0 ; $i < count($nums) ; $i++){
        echo $nums[$i] . " ";
    }
    echo "<br>";

    //ordenar y mostrar
    sort($nums);
    print_r($nums);
    echo "<br>";

    echo "tamaño: " . count($nums) . "<br>";

    echo "indice 0: " . $nums[0] . "<br>";

    echo "indice por URL: " . $nums[$_GET["n"]];

?>
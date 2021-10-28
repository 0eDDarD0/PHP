<?php

    $array = [];
    for($i = 0 ; $i < 15 ; $i++){
        $array[] = rand(0, 100);
    }

    print_r($array);
    echo "<br><br>";

    $ultimo = $array[count($array) - 1];

    for($i = 14 ; $i > 0 ; $i--){
        $array[$i] = $array[$i - 1];
    }
    $array[0] = $ultimo;

    print_r($array);

?>
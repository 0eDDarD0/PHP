<?php

    $array = [];

    for($i = 0 ; $i < 8 ; $i++){
        $array[] = rand(0,1);
    }

    print_r($array);
    echo '<br>';
    $complementario = [];

    for($i = 0 ; $i < 8 ; $i++){
        $complementario[$i] = (int)!$array[$i]; //el elemento del complementario es el opuesto del principal
    }

    print_r($complementario);

?>
<?php

    $valores = [];
    for($i = 0 ; $i < 20 ; $i++){
        $valores[] = rand(0, 100);
    }

    $cuadrados = [];
    for($i = 0 ; $i < 20 ; $i++){
        $cuadrados[] = $valores[$i] ** 2;
    }

    $cubos = [];
    for($i = 0 ; $i < 20 ; $i++){
        $cubos[] = $valores[$i] ** 3;
    }

    print_r($valores);
    echo '<br><br>';
    print_r($cuadrados);
    echo '<br><br>';
    print_r($cubos);


?>
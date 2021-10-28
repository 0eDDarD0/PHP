<?php

    //pasar a funciones por copia y por referncia y valor default
    function prueba($n1, &$n2, $nombre = 'Paco'){

        $n1++;
        $n2++;
        echo $nombre . '<br>';
    }

    $n1 = 10;
    $n2 = 10;
    prueba($n1, $n2);
    echo $n1 . ' ' . $n2;


    //si una variable contiene el mismo nombre que una funcion(da igual mayus) si llamamos a la variable como una funcion actua como tal
    // function buenasDias(){
    //     return "Hola, buenos dias";
    // }
    // function buenasTardes(){
    //     return "Hola, buenas tardes";
    // }
    // function buenasNoches(){
    //     return "Hola, buenas noches";
    // }
    // $horario = "Noches";
    // $mifuncion = "buenas" . $horario;
    // echo $mifuncion();
    // $horario = "Tardes";
    // $mifuncion = "buenas" . $horario;
    // echo $mifuncion();
    // $horario = "dias";
    // $mifuncion = "buenas" . $horario;
    // echo $mifuncion();

?>
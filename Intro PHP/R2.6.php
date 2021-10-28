<?php

    //Escribe una función que calcule el máximo común divisor de dos números y un programa para probarla. 

    function frac($a,$b){
        return ($a / $b) - (int)($a / $b); // Con esta funcion averiguamos si un numero es divisible por otro
    }  

    function mcd($a,$b){
        $maximo = 1;

        for($i = 1 ; $i < min($a,$b) + 1 ; $i++){  //miramos los divisores hasta el minimo de los dos
            if($a % $i == 0 && $b % $i == 0)  //comprobamos que los dos numeros son divisibles
                $maximo = $i;  //como tiene que ser mayor que el anterior lo cambiamos
        }
        return $maximo;
    }

    $primero = 70;
    $segundo = 30;

    echo "El maximo común divisor de " . $primero . " y " . $segundo . " es: " . mcd(70, 20);
    
?>
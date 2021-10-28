<?php

    function calculadora($n1, $n2, $o){

        switch($o){
            case '+':
                return $n1 + $n2;
            case '-':
                return $n1 - $n2;
            case '*':
                return $n1 * $n2;
            case '/':
                return $n1 / $n2;
        }
    }

    echo calculadora(10, 20, '*');

?>
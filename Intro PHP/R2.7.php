<?php

    function esPrimo($n){
        $es = true;
        
        for($i = round($n / 2) ; $i > 1 ; $i--){
            if($n % $i == 0)
                $es = false;
        }

        return $es;
    }

    echo esPrimo(37);

?>
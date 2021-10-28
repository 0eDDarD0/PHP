<?php

    // function factorial($n){

    //     for($i = $n - 1 ; $i > 0 ; $i--){
    //         $n *= $i;
    //     }

    //     return $n;
    // }

    function factorial($n){

        if($n == 1){
            return $n;
        }else{
            return $n * factorial($n - 1);
        }
    }

    echo factorial(4);

?>
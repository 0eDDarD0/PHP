<?php

    function cambiaVariable(&$v){

        if(empty($v)){
            $v = 'frase de relleno';
            echo strtoupper($v);
        }else{
            unset($v);
        }
    }

    $a = 2;
    cambiaVariable($a);

?>
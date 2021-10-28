<?php

    function matricula($m){
        $es = true;

        if(strlen($m) == 7){
            for($i = 0 ; $i < 7 ; $i++){
                if($i < 4 && ($m[$i] < 0 || $m[$i] > 9)){
                    $es = false;
                }else if($i >= 4 && strtoupper($m[$i]) != $m[$i]){
                    $es = false;
                }
            }
        }else{
            $es = false;
        }

        return $es;
    }

    echo matricula("....EEE") . "<br>";
    echo matricula("0000CXF");

?>
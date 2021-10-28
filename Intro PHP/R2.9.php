<?php

    function contrasenia($c){
        $nums = "0123456789";
        $mins = "qwertyuiopasdfghjklñzxcvbnm";
        $mayus = "QWERTYUIOPASDFGHJKLÑZXCVBNM";
        $sym = "º|@#~€¬!$%&/()=?¿¡^`[]*+{}´¨,;.:-_<>";
        $esnums = false;
        $esmins = false;
        $esmayus = false;
        $essym = false; 

        if(strlen($c) >= 6 && strlen($c) <= 15){
            
            for($i = 0 ; $i < strlen($c) ; $i++){
                if(strpos($nums, $c[$i]))
                    $esnums = true;
                elseif(strpos($mayus, $c[$i]))
                    $esmins = true;
                elseif(strpos($mins, $c[$i]))
                    $esmayus = true;
                elseif(strpos($sym, $c[$i]))
                    $essym = true;      
            }        
        }else{
            return false;
        }

        if($esnums == true && $esmins == true && $esmayus == true && $essym == true){
            return true;
        }else{
            return false;
        }
    }

    echo contrasenia("1eE?ee");

?>
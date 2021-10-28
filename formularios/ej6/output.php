<?php

        $alumnos = [
            "Paco" => 1,
            "Maria" => 9,
            "Federico" => 5,
            "Manuela" => 4,
            "Pepe" => 7,
    
        ];
        $alumnos[$_POST["name"]] = $_POST["nota"];

        $sum = 0;
        foreach($alumnos as $a){
            echo array_search($a, $alumnos) . " " . $a . "<br>";
            $sum += $a;
        }
        echo "Media: " . $sum / count($alumnos);

?>
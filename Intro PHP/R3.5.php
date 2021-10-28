<?php

    function muestra_zoo($zoo){
        foreach($zoo as $animal){
            print("&#$animal");
        }
        echo "Quedan: " . count($zoo);
    }

    function zoo(){
        $tam = rand(20, 30);
        $zoo = [];

        for($i = 0 ; $i < $tam ; $i++){
            $zoo[] = rand(128000, 128060);
        }

        muestra_zoo($zoo);

        return $zoo;
    }

    $grupo = zoo();
    $eliminado = array_rand($grupo);
    echo "<br><br>" . "Morira: " . "&#" . $grupo[$eliminado] . "<br><br>";
    unset($grupo[$eliminado]);

    muestra_zoo($grupo);

?>
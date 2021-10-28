<?php

    //b)
    function numeros($a){
        foreach($a as $v){
            echo $v["nombre"] . " " . $v["num"] . "<br>";
        }
    }

    //a)
    $profes = [
        ["num" => 1, "nombre" => "Pepe", "apellido" => "Gonzalez", "telefono" => 111111111, "fecha" => "1-1-1980"], 
        ["num" => 2, "nombre" => "Maria", "apellido" => "Benitez", "telefono" => 222222222, "fecha" => "2-2-2001"], 
        ["num" => 3, "nombre" => "Rocio", "apellido" => "Fernandez", "telefono" => 333333333, "fecha" => "3-3-2002"]
    ];

    //numeros($profes);

    //c)
    array_map(function($v){
        echo $v["nombre"] . " " . $v["num"] . "<br>";
    }, $profes);

    //d)
    $jovenes = (array_filter($profes, function($value){
        return strtotime($value["fecha"]) > strtotime("1-1-1990");
    }));
    foreach($jovenes as $j){
        echo $j["nombre"] . "<br>";
    }

?>
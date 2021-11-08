<?php

    if(!is_dir('carpeta_nueva')){
        mkdir('carpeta_nueva', 0777) or die("No se puede crear la carpeta");
    }else{
        echo "La carpeta ya existe<br>";
    }

    if($gestor = opendir("./carpeta_nueva")){
        while(($archivo = readdir($gestor))){
            if($archivo != '.' && $archivo != '..'){
                echo $archivo . "<br>";
            }
        }
    }

?>
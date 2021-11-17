<?php

    try{
        require_once "perro.php";

        $p1 = new Perro(80, "Labrador", "Blanco", "Balto");
        $p1->mostrar_propiedades();
        $p1 = new Perro(40, "Caniche", "Marron", "Pompom");
        $p1->speak();
    }catch(Error $e){
        echo "Error fatal, no se encuentra el fichero necesario<br>" . $e;
    }

?>
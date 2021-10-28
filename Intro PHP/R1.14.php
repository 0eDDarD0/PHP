<?php

$longitud = rand(1, 1000); 
echo "Longitud: " . $longitud . "<br>";

echo ' <svg height="1000" width="' . $longitud . '">
        <line x1="0" y1="0" x2="1000" y2="0" style="stroke:rgb(0,0,0);stroke-width:2" />
        </svg> ';

?>
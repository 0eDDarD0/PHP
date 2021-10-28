<?php

$t1 = rand(1, 6);
$t2 = rand(1, 6);
echo '<img width=200 height=200 src="img/dice-' . $t1 . '.svg">';
echo '<img width=200 height=200 src="img/dice-' . $t2 . '.svg"><br>';


if($t1 > $t2)
    echo "El primer dado es mayor que el segundo";
else if($t1 == $t2)
    echo "El primer dado es igual que el segundo";
else
    echo "El primer dado es menor que el segundo";

?>
<?php

$a = 2;
$b = 5;
$c = 3;

echo "solucion 1: " . ((-$b + sqrt($b**2 - 4*$a*$c)) / (2 * $a));
echo "<br>solucion 2: " . ((-$b - sqrt($b**2 - 4*$a*$c)) / (2 * $a));

?>
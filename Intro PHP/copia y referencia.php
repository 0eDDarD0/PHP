<?php

    $valor = 100;
    $referencia = &$valor;
    $copia = $valor;

    print($valor);
    print("<br>".$referencia);
    print("<br>".$copia);

    $valor = 101;

    print("<br>".$valor);
    print("<br>".$referencia);
    print("<br>".$copia);

?>
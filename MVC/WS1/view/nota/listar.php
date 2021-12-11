<?php

    while($fila = $notas->fetch(PDO::FETCH_ASSOC)){
        print_r($fila);
        echo '<br>';
    }

?>
<?php

    while($fila = $usuarios->fetch(PDO::FETCH_ASSOC)){
        print_r($fila);
        echo '<br>';
    }

?>
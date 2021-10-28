<?php

    echo '<table border="solid">';
    foreach($_SERVER as $value){
        echo '<tr><td>' . array_search($value, $_SERVER) . '</td><td>' . $value . '</td></tr>';
    }
    echo '</table>';

?>
<?php

    setcookie("idioma", $_REQUEST["lang"], time() + (60 * 2));
    header('Location: ej2.php');

?>


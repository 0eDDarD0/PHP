<?php

    header('Cache-control: no-cache, must-revalidate');
    header('Refresh: 10; URL='.$_SERVER["PHP_SELF"]);

    echo strftime("%A, %d of %B of %Y %H:%M:%S", time());

?>
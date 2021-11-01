<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php

        function quitarCaracteres($a){
            return stripslashes(trim(htmlspecialchars($a)));
        }

        $error_name = false;
        $error_surname = false;
        $error_mail = false;
        $error_tlf = false;
        $error_job = false;
        $error_language = false;
        $error_url = false;

        if($_SERVER["REQUEST_METHOD"] == "POST"){   //validacion de todos los datos
            $name = quitarCaracteres($_REQUEST["name"]);
            if(empty($name) || (preg_match('/[^a-zA-Z]/', $name))){
                $error_name = true;
            }
        
            $surname = $_REQUEST["surname"];
            if(empty($surname) || (preg_match('/[^a-z A-Z]/', $surname))){
                $error_surname = true;
            }

            $mail = quitarCaracteres($_REQUEST["mail"]);
            if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
                $error_mail = true;
            }

            $tlf = quitarCaracteres($_REQUEST["tlf"]);
            if(empty($tlf) || (preg_match('/[^0-9]/', $tlf)) || strlen($tlf) != 9){
                $error_tlf = true;
            }

            if(empty($_REQUEST["job"])){
                $error_job = true;
            }else{
                $job = $_REQUEST["job"];
            }

            if(empty($_REQUEST["language"])){
                $error_language = true;
            }else{
                $language = $_REQUEST["language"];
            }

            $url = quitarCaracteres($_REQUEST["url"]);
            if(!filter_var($url, FILTER_VALIDATE_URL)){
                $error_url = true;
            }
        }

    ?>
    
    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> method="post" name="formulario">
        Nombre:<br>
        <input type="text" name="name" value="<?php if($_SERVER["REQUEST_METHOD"] == "POST") echo $name?>">
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(!$error_name){
                    echo "<p>" . $name . "</p>";
                }else{
                    echo '<p style="color:red;">error en el nombre</p>';
                }
            }
        ?>

        <br>Apellidos:<br>
        <input type="text" name="surname" value="<?php if($_SERVER["REQUEST_METHOD"] == "POST") echo $surname?>">
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(!$error_surname){
                    echo "<p>" . $surname . "</p>";
                }else{
                    echo '<p style="color:red;">error en el apellido</p>';
                }
            }
        ?>

        <br>Correo:<br>
        <input type="text" name="mail"  value="<?php if($_SERVER["REQUEST_METHOD"] == "POST") echo $mail?>">
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(!$error_mail){
                    echo "<p>" . $mail . "</p>";
                }else{
                    echo '<p style="color:red;">error en el correo</p>';
                }
            }
        ?>

        <br>Teléfono:<br>
        <input type="text" name="tlf" value="<?php if($_SERVER["REQUEST_METHOD"] == "POST") echo $tlf?>">
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(!$error_tlf){
                    echo "<p>" . $tlf . "</p>";
                }else{
                    echo '<p style="color:red;">error en el telefono</p>';
                }
            }
        ?>

        <br>Sin empleo
        <input type="radio" name="job" value="no"><br>
        A tiempo completo
        <input type="radio" name="job" value="full"><br>
        A tiempo parcial
        <input type="radio" name="job" value="partial"><br>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(!$error_job){
                    echo "<p>" . $job . "</p>";
                }else{
                    echo '<p style="color:red;">error, elija una opcion</p>';
                }
            }
        ?>

        <br>Python
        <input type="checkbox" name="language[]" value="python"><br>
        C++
        <input type="checkbox" name="language[]" value="cpp"><br>
        PHP
        <input type="checkbox" name="language[]" value="php"><br>
        JavaScript
        <input type="checkbox" name="language[]" value="js"><br>
        Java
        <input type="checkbox" name="language[]" value="java"><br>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(!$error_language){
                    print_r($language);
                }else{
                    echo '<p style="color:red;">error, elija una opcion</p>';
                }
            }
        ?>

        <br>URL:<br>
        <input type="text" name="url" value="<?php if($_SERVER["REQUEST_METHOD"] == "POST") echo $url?>">
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(!$error_url){
                    echo "<p>" . $url . "</p>";
                }else{
                    echo '<p style="color:red;">error en la URL</p>';
                }
            }
        ?>

        <br><input type="submit">
    </form>

</body>
</html>
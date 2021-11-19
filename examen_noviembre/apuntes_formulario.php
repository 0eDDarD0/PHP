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

        //Funcion que elimina los caracteres extraños en la entrada de datos
        function quitarCaracteres($a){
            return stripslashes(trim(htmlspecialchars($a)));
        }

        //Variables que indican los compos en los que hay errores
        $error_name = false;
        $error_surname = false;
        $error_mail = false;
        $error_tlf = false;
        $error_job = false;
        $error_language = false;
        $error_url = false;

        ///////////////////////////////////////////////////////////////ENTRADA POST
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            //VALIDACION NOMBRE
            $name = quitarCaracteres($_REQUEST["name"]);
            if(empty($name) || (preg_match('/[^a-zA-Z]/', $name))){
                $error_name = true;
            }
        
            //VALIDACION APELLIDOS
            $surname = $_REQUEST["surname"];
            if(empty($surname) || (preg_match('/[^a-z A-Z]/', $surname))){
                $error_surname = true;
            }

            //VALIDACION CORREO
            $mail = quitarCaracteres($_REQUEST["mail"]);
            if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
                $error_mail = true;
            }

            //VALIDACION TELEFONO
            $tlf = quitarCaracteres($_REQUEST["tlf"]);
            if(empty($tlf) || (preg_match('/[^0-9]/', $tlf)) || strlen($tlf) != 9){
                $error_tlf = true;
            }

            //VALIDACION RADIO
            if(empty($_REQUEST["job"])){
                $error_job = true;
            }else{
                //asignamos para trabajar mas facilmente
                $job = $_REQUEST["job"];
            }

            //VALIDACION CHECKBOX
            if(empty($_REQUEST["language"])){
                $error_language = true;
            }else{
                //asignamos para trabajar mas facilmente
                $language = $_REQUEST["language"];
            }

            //VALIDACION URL
            $url = quitarCaracteres($_REQUEST["url"]);
            if(!filter_var($url, FILTER_VALIDATE_URL)){
                $error_url = true;
            }
        }

    ?>
    
    <!---------------------------------------------------FORMULARIO--------------------------------------------------->
    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> method="post" name="formulario">
        Nombre:<br>
        <input type="text" name="name">
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(!$error_name){//COMPRUEBA LOS ERRORES
                    echo "<p>" . $name . "</p>";
                }else{
                    echo '<p style="color:red;">error en el nombre</p>';
                }
            }
        ?>

        <br>Apellidos:<br>
        <input type="text" name="surname">
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(!$error_surname){//COMPRUEBA LOS ERRORES
                    echo "<p>" . $surname . "</p>";
                }else{
                    echo '<p style="color:red;">error en el apellido</p>';
                }
            }
        ?>

        <br>Correo:<br>
        <input type="text" name="mail">
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(!$error_mail){//COMPRUEBA LOS ERRORES
                    echo "<p>" . $mail . "</p>";
                }else{
                    echo '<p style="color:red;">error en el correo</p>';
                }
            }
        ?>

        <br>Teléfono:<br>
        <input type="text" name="tlf">
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(!$error_tlf){//COMPRUEBA LOS ERRORES
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
                if(!$error_job){//COMPRUEBA LOS ERRORES
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
                if(!$error_language){//COMPRUEBA LOS ERRORES
                    print_r($language);
                }else{
                    echo '<p style="color:red;">error, elija una opcion</p>';
                }
            }
        ?>

        <br>URL:<br>
        <input type="text" name="url">
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(!$error_url){//COMPRUEBA LOS ERRORES
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
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

        if($_SERVER["REQUEST_METHOD"] == "POST"){ //quita todos los caracteres extraños e inicializa los datos
            $name = quitarCaracteres($_REQUEST["name"]);
            $tlf = quitarCaracteres($_REQUEST["tlf"]);
            $mail = quitarCaracteres($_REQUEST["mail"]);
        }

    ?>
    
    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> method="post" name="formulario">
        Nombre:<br>
        <input type="text" name="name" value="<?php if($_SERVER["REQUEST_METHOD"] == "POST") echo $name?>">
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(!empty($name) && !(preg_match('/[^a-zA-Z]/', $name))){
                    echo "<p>" . $name . "</p>";
                }else{
                    echo '<p style="color:red;">error en el nombre</p>';
                }
            }
        ?>

        <br>Teléfono:<br>
        <input type="text" name="tlf" value="<?php if($_SERVER["REQUEST_METHOD"] == "POST") echo $tlf?>">
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(!empty($tlf) && !(preg_match('/[^0-9]/', $tlf)) && strlen($tlf) == 9){
                    echo "<p>" . $tlf . "</p>";
                }else{
                    echo '<p style="color:red;">error en el telefono</p>';
                }
            }
        ?>

        <br>Correo:<br>
        <input type="text" name="mail"  value="<?php if($_SERVER["REQUEST_METHOD"] == "POST") echo $mail?>">
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
                    echo "<p>" . $mail . "</p>";
                }else{
                    echo '<p style="color:red;">error en el correo</p>';
                }
            }
        ?>

        <br><input type="submit">
    </form>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> method="post">
        <label for="name">Nombre
            <input type="text" name="name">
        </label><br>
        <label for="telf">Telefono
            <input type="text" name="telf">
        </label><br>
        <label for="mail">Correo
            <input type="text" name="mail">
        </label><br>
        <input type="submit">
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            echo "¡Buenos días, " . $_POST["name"] . 
            "Te voy a enviar spam a " . $_POST["mail"] . 
            " y te llamaré de madrugada a " . $_POST["telf"] . ". Enviado desde un iPhone";
        }
    ?>
</body>
</html>
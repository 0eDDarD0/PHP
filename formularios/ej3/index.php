<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?> method="post">
        Nombre: 
        <input required type="text" name="usuario"><br>
        Contraseña:
        <input required type="password" name="contrasenia"><br>
        <input type="submit"><br>
    </form>

    <?php

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if($_POST["usuario"] == "usuario" && $_POST["contrasenia"] == "1234"){
                header("Location:bienvenido.html");
            }else{
                echo '<p style="color: red;">La contraseña o el usuario no son validos</p><br>';
            }
        }

    ?>

</body>
</html>
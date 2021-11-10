<!DOCTYPE html>

<?php
 
        if(isset($_GET['err'])){
            if($_GET['err'] == 1){
                echo '<p style="color:red;">Error en el login, inténtelo de nuevo</p>';
            }
        }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="logeado.php" method="post">
        <label for="">Usuario:<br>
            <input type="text" name="user" id="user">
        </label><br>
        <label for="">Contraseña:<br>
            <input type="password" name="password" id="password">
        </label><br>
        <input type="submit" value="enviar">
    </form>

</body>
</html>
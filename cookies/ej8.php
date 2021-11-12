<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        setcookie("user", $_REQUEST["user"], time() + $_REQUEST["tiempo"]);
        header('Location: ej8.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h1>Crea tu propia Cookie!</h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="user">Usuario<br>
            <input type="text" name="user" id="user">
        </label><br>
        <label for="tiempo">Duración de la Cookie (de 1s a 60s)<br>
            <input type="text" name="tiempo" id="tiempo">
        </label><br>
        <input type="submit" value="Crear Cookie">
    </form>
    <form action="borrado.php">
        <input type="submit" value="Borrar cookies">
    </form>

<?php

    if(isset($_COOKIE["user"])){
        echo "Segun tu Cookie eres: " . $_COOKIE["user"];
    }

?>

</body>
</html>
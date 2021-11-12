<!DOCTYPE html>

<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        setcookie("color", $_REQUEST["color"], time() + 60);
        header('Location: ej3.php');
    }else{
        if(isset($_COOKIE["color"])){
            $color = $_COOKIE["color"];
        }else{
            $color = "white";
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
<body style="<?php echo "background-color:" . $color . ";" ?>">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="color" name="color" id="color">
        <input type="submit" value="enviar">
    </form>
</body>
</html>
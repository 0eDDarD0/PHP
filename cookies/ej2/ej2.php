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

    if(!isset($_COOKIE["idioma"])){
        setcookie("idioma", "esp", time() + (60 * 2));
    }      

?>

    <form action="process.php" method="post">
        <label for="lang"><?php echo $_COOKIE["idioma"] == "esp" ? "Español" : "Spanish" ?>
            <input type="radio" name="lang" id="lang" <?php echo $_COOKIE["idioma"] == "esp" ? "checked" : "" ?> value="esp">
        </label>
        <label for="lang"><?php echo $_COOKIE["idioma"] == "eng" ? "English" : "Inglés" ?>
            <input type="radio" name="lang" id="lang" <?php echo $_COOKIE["idioma"] == "eng" ? "checked" : "" ?> value="eng">
        </label>        
        <input type="submit" value="<?php echo $_COOKIE["idioma"] == "eng" ? "Submit" : "Enviar" ?>">
    </form>
    
    <?php

        if(isset($_COOKIE["idioma"])){
            if($_COOKIE["idioma"] == "esp"){
                echo "hola";
            }else if($_COOKIE["idioma"] == "eng"){
                echo "hello";
            }            
        }      

    ?>

</body>
</html>


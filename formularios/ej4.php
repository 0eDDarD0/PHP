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
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            echo $_REQUEST["alt"] * $_REQUEST["bas"] / 2;
        }
    ?>
    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> method="post">
        <label for="alt">Altura
            <input type="text" name="alt" value="<?php if(isset($_REQUEST["bas"]))echo $_REQUEST["bas"]; ?>">
        </label>
        <label for="bas">Base
            <input type="text" name="bas" value="<?php if(isset($_REQUEST["alt"]))echo $_REQUEST["alt"]; ?>">
        </label>
        <input type="submit">
    </form>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <input type="file" name="fichero" id="">
        <input type="submit" value="Clicame">
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $mov = move_uploaded_file($_FILES["fichero"]["tmp_name"],"subidos/" . $_FILES["fichero"]["name"]);
            if($mov){
                echo "exito al subir el archivo " . $_FILES["fichero"]["name"];
            }else{
                echo "error al subir el archivo";
            }
        }
    ?>

</body>
</html>
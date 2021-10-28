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

            try{
                $nombre = $_REQUEST["fname"];
                $apellidos = $_REQUEST["sname"];
                $edad = (int)$_REQUEST["age"];
                
                if(isset($nombre)){
                    if(is_string($nombre) && !(preg_match('/[^a-zA-Z ]/', $nombre)))
                        $nombre = htmlspecialchars($nombre, ENT_QUOTES, "UTF-8");
                    else
                        $nombre = "";
                }else{
                    $nombre = "";
                }
    
                if(isset($apellidos)){
                    if(is_string($apellidos) && !(preg_match('/[^a-zA-Z ]/', $apellidos)))
                        $apellidos = htmlspecialchars($apellidos, ENT_QUOTES, "UTF-8");
                    else
                        $apellidos = "";
                }else{
                    $apellidos = "";
                }

                if(isset($edad)){
                    if(is_int($edad))
                        $edad = htmlspecialchars($edad, ENT_QUOTES, "UTF-8");
                    else
                        $edad = 0;
                }else{
                    $edad = 0;
                }

            }catch(Error $e){
                echo "Error en la validacion<br>" . $e;
            }
        
            //echo $nombre . "<br>" . $apellidos . "<br>" . $edad . "<br>"; 
            if($nombre && $apellidos && $edad){
                echo "Nombre: " . $nombre . "<br>Apellidos: " . $apellidos . "<br>Edad: " . $edad;
            }else{
                echo "Error en la validacion intentelo de nuevo";
            }
        }

    ?>
</body>
</html>
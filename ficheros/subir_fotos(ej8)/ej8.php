<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" name="formulario">
        <input type="file" name="imagen" id="imagen">
        <input type="submit" value="Subir foto...">
    </form>

    <?php
    
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            //comprueba si existe una carpeta para almacenar las fotos, si no la crea
            if(!is_dir('fotos')){   
                mkdir('fotos', 0777) or die("No se puede crear la carpeta");
            }

            //comprueba que la imagen es de formato jpg, png o jpeg, si no, no mueve el archivo a la carpeta de fotos
            if(($_FILES["imagen"]["type"] ==  "image/jpg") || ($_FILES["imagen"]["type"] ==  "image/png") || ($_FILES["imagen"]["type"] ==  "image/jpeg")){
                $mov = move_uploaded_file($_FILES["imagen"]["tmp_name"],"fotos/" . $_FILES["imagen"]["name"]); //mueve la imagen del fichero temporal al fichero de las fotos
            }else{
                echo "El archivo no es válido, por favor seleccione una imagen<br>";
            }
            
            //crea un array con todas las fotos de la carpeta fotos
            $imagenes = [];
            if($gestor = opendir("./fotos")){   //abre el archivo
                while(($archivo = readdir($gestor))){   //mientras queden archivos en la carpeta sin leer...
                    if($archivo != '.' && $archivo != '..'){    //evita el directorio padre y el mismo
                        $imagenes[] = $archivo;
                    }
                }
            }else{
                echo "Error al abrir el directorio<br>";
            }

            //muestra todas las fotos
            foreach($imagenes as $i){
                echo '<img src="./fotos/' . $i . '"><br>';
            }
        }

    ?>

</body>
</html>
<?php
require_once './vendor/autoload.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //LE PASAMOS LA CARPETA DONDE SE ALMACENARAN LOS FICHEROS
    $storage = new \Upload\Storage\FileSystem('./subidas');
    //LE PASAMOS EL NAME DEL INPUT DEL FICHERO
    $file = new \Upload\File('imagen', $storage);

    //[OPCIONAL] CAMBIAR EL NOMBRE DEL FICHERO A SUBIR Y DARLE POR EJEMPLO UNA ID UNICA
    //$new_filename = uniqid();
    //$file->setName($new_filename);

    //AÑADIMOS TODAS LAS VALIDACIONES QUE QUERAMOS HACER
    $file->addValidations(array(
        //NOS ASEGURAMOS DE QUE LA EXTENSION DEL ARCHIVO SEA PROPIA DE UNA IMAGEN
        new \Upload\Validation\Extension(array('jpg', 'jpeg', 'png', 'gif')),

        //NOS ASEGURAMOS DE QUE EL ARCHIVO NO PESE MAS DE 100KB (usamos los siguientes char para las unidades: "B", "K", M", or "G")
        new \Upload\Validation\Size('1M')
    ));

    //[OPCIONAL] SI QUEREMOS RECOGER ALGUN DATO DE LA IMAGEN A SUBIR TENDREMOS QUE HACERLO ANTES DE LLAMAR A UPLOAD
    $data = array(
        //'name'       => $file->getNameWithExtension(),
        //'extension'  => $file->getExtension(),
        //'mime'       => $file->getMimetype(),
        //'size'       => $file->getSize(),
        //'md5'        => $file->getMd5(),
        'dimensions' => $file->getDimensions()
    );

    //TRATA DE VALIDAR Y SUBIR EL ARCHIVO (TODO EN LA MISMA FUNCION UPLOAD)
    try {
        $file->upload();
        //SI SE VALIDA CORECTAMENTE EL ARCHIVO SE SUBIRA A LA CARPETA PASADA Y PODREMOS MOSTRAR UN MENSAJE DE EXITO
        echo "Ancho: " . $data['dimensions']['width'] . "<br>Alto: " . $data['dimensions']['height'];
    } catch (\Exception $e) {
        //SI LA VALIDACION FALLA PODEMOS RECOGER LOS ERRORES POR LOS QUE HA FALLADO Y MOSTRARLOS
        $errors = $file->getErrors();        
        for($i = 0 ; $i < count($errors) ; $i++){
            echo $errors[$i] ."<br>";
        }
    }

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
    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
        <input type="file" name="imagen"/>
        <input type="submit" value="Upload File"/>
    </form>
</form>
</body>
</html>
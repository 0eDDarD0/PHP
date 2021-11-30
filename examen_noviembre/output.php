<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $error = false;

        function quitarCaracteres($a){
            return stripslashes(trim(htmlspecialchars($a)));
        }

        //VALIDACION TIPO
        $tipo = quitarCaracteres($_REQUEST["tipo"]);
        if(empty($tipo)){
            echo '<p style="color:red;">error en el tipo</p>';
            $error = true;
        }else{
            echo 'Tipo: '. $tipo . '<br>';
        }
    

        //VALIDACION ZONA
        $zona = quitarCaracteres($_REQUEST["zona"]);
        if(empty($zona)){
            echo '<p style="color:red;">error en la zona</p>';
            $error = true;
        }
        else{
            echo 'Zona: '. $zona . '<br>';
        }


        //VALIDACION DIRECCION
        $direccion = quitarCaracteres($_REQUEST["direccion"]);
        if(empty($direccion) || (preg_match('/[^a-z A-Z0-9º\/]/', $direccion))){
            echo '<p style="color:red;">error en la direccion</p>';
            $error = true;
        }else{
            echo 'Direccion: '. $direccion . '<br>';
        }


        //VALIDACION NUMERO DE HABITACIONES
        $num = quitarCaracteres($_REQUEST["num"]);
        if(empty($num)){
            echo '<p style="color:red;">Debe elegir un numero</p>';
            $error = true;
        }else{
            echo 'Numero de habitaciones: '. $num . '<br>';
        }


        //VALIDACION PRECIO
        $precio = quitarCaracteres($_REQUEST["precio"]);
        if(empty($precio) || (preg_match('/[^0-9]/', $precio))){
            echo '<p style="color:red;">El precio debe ser un numero</p>';
            $error = true;
        }else{
            echo 'Precio: '. $precio . '<br>';
        }


        //VALIDACION TAMAÑO
        $tamanio = quitarCaracteres($_REQUEST["tamanio"]);
        if(empty($tamanio) || (preg_match('/[^0-9]/', $tamanio))){
            echo '<p style="color:red;">El tamaño debe ser un numero</p>';
            $error = true;
        }else{
            echo 'Tamaño: '. $tamanio . 'm2<br>';
        }


        //NO VALIDAMOS LOS EXTRAS POQUE PUEDEN ESTAR O NO ESTAR
        if(empty($_REQUEST["extras"])){
            echo 'Extras: Ninguno';
            $extras = 'no';
        }else{
            $extras = '';
            echo 'Extras:';
            for($i = 0 ; $i < count($_REQUEST["extras"]) ; $i++){
                echo '<br>' . $_REQUEST["extras"][$i];
                $extras  = $extras . $_REQUEST["extras"][$i].' ';
            }
        }


        //comprueba si existe una carpeta para almacenar las fotos, si no la crea
        if(!is_dir('fotos')){   
            mkdir('fotos', 0777) or die("No se puede crear la carpeta");
        }
        //comprueba que la imagen es de formato jpg, png o jpeg, si no, no mueve el archivo a la carpeta de fotos
        if(($_FILES["imagen"]["type"] ==  "image/jpg") || ($_FILES["imagen"]["type"] ==  "image/png") || ($_FILES["imagen"]["type"] ==  "image/jpeg")){
            if(filesize($_FILES["imagen"]["tmp_name"]) > 100000){
                echo '<p style="color:red;">La foto es demasiado grande</p>';
                $error = true;
            }else{
                $mov = move_uploaded_file($_FILES["imagen"]["tmp_name"],"fotos/" . $_FILES["imagen"]["name"]); //mueve la imagen del fichero temporal al fichero de las fotos
                echo '<br>Foto: <a target="blank" href="./fotos/'.$_FILES["imagen"]["name"].'">'.$_FILES["imagen"]["name"].'</a>';
                $foto = $_FILES["imagen"]["name"];
            }
        }else{
            echo '<p style="color:red;">error en la foto</p>';
            $error = true;
        }


        //NO VALIDAMOS LAS OBSERVACIONES PORQUE PUEDEN ESTAR O NO ESTAR
        if(empty($_REQUEST["observaciones"])){
            echo '<br>Observaciones: Ninguna';
            $observaciones = 'no';
        }else{
            $observaciones = $_REQUEST["observaciones"];
            echo '<br>Observaciones: ' . $observaciones;
        }

        $comision = 0;
        $precio = (int)$precio;
        switch($zona){
            case 'Centro':
                if($tamanio < 100){
                    echo '<br>Comisión: ' . $precio * 0.3 . '€(30%)';
                    $comision = $precio * 0.3;
                }else{
                    echo '<br>Comisión: ' . $precio * 0.35 . '€(35%)';
                    $comision = $precio * 0.35;
                }
                break;
            case 'Zaidin':
                if($tamanio < 100){
                    echo '<br>Comisión: ' . $precio * 0.25 . '€(25%)';
                    $comision = $precio * 0.25;
                }else{
                    echo '<br>Comisión: ' . $precio * 0.28 . '€(28%)';
                    $comision = $precio * 0.28;
                }
                break;
            case 'Chana':
                if($tamanio < 100){
                    echo '<br>Comisión: ' . $precio * 0.22 . '€(22%)';
                    $comision = $precio * 0.22;
                }else{
                    echo '<br>Comisión: ' . $precio * 0.25 . '€(25%)';
                    $comision = $precio * 0.25;
                }
                break;
            case 'Albaicín':
                if($tamanio < 100){
                    echo '<br>Comisión: ' . $precio * 0.2 . '€(20%)';
                    $comision = $precio * 0.2;
                }else{
                    echo '<br>Comisión: ' . $precio * 0.35 . '€(35%)';
                    $comision = $precio * 0.35;
                }
                break;
            case 'Sacromonte':
                if($tamanio < 100){
                    echo '<br>Comisión: ' . $precio * 0.22 . '€(22%)';
                    $comision = $precio * 0.22;
                }else{
                    echo '<br>Comisión: ' . $precio * 0.25 . '€(25%)';
                    $comision = $precio * 0.25;
                }
                break;
            case 'Realejo':
                if($tamanio < 100){
                    echo '<br>Comisión: ' . $precio * 0.25 . '€(25%)';
                    $comision = $precio * 0.25;
                }else{
                    echo '<br>Comisión: ' . $precio * 0.38 . '€(28%)';
                    $comision = $precio * 0.38;
                }
                break;
        }

        //SI NO HA HABIDO NINGUN ERROR METE LOS DATOS EN EL FICHERO
        if(!$error){
            $f = fopen("viviendas.txt", 'a');
            if($f){
                fwrite($f, $tipo."\n");
                fwrite($f, $zona."\n");
                fwrite($f, $direccion."\n");
                fwrite($f, $num."\n");
                fwrite($f, $precio."\n");
                fwrite($f, $tamanio."\n");
                fwrite($f, $extras."\n");
                fwrite($f, $foto."\n");
                fwrite($f, $comision."\n");
                fwrite($f, $observaciones."\n\n");
            }else{
                echo "Error al abrir el fichero<br>";
            }
        }

        echo '<br><a href="form.php">Insertar otra vivienda</a>';
    }

?>
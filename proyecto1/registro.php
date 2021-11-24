<?php
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        function quitarCaracteres($a){
            return stripslashes(trim(htmlspecialchars($a)));
        }

        //VALIDACION NOMBRE
        $nombre = quitarCaracteres($_REQUEST["nombre"]);
        if(empty($nombre) || preg_match('/[^a-z A-Z0]/', $nombre)){
            $_SESSION["error_nombre"] = true;
        }

        //VALIDACION APELLIDOS
        $apellidos = quitarCaracteres($_REQUEST["apellidos"]);
        if(empty($apellidos) || preg_match('/[^a-z A-Z0]/', $apellidos)){
            $_SESSION["error_apellidos"] = true;
        }

        //VALIDACION CORREO
        $correo = quitarCaracteres($_REQUEST["correo"]);
        if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $_SESSION["error_correo"] = true;
        }

        //VALIDACION CONTRASEÑA
        $contrasenia = quitarCaracteres($_REQUEST["contrasenia"]);
        if(empty($contrasenia) || preg_match('/[^a-zA-Z0-9_\-!¡?¿+*]/', $contrasenia)){
            $_SESSION["error_contrasenia"] = true;
        }



        if(isset($_SESSION["error_nombre"]) || isset($_SESSION["error_apellidos"]) || isset($_SESSION["error_correo"]) || isset($_SESSION["error_contrasenia"])){
           header('Location: index.php');
        }else{
            $con = @mysqli_connect('localhost', 'fer', 'root', 'proyecto1');
            if(!mysqli_connect_errno()){
                mysqli_query($con, "SET NAME 'utf-8'"); //nos aseguramos de que la codificacion sea utf 8
                $nombre = mysqli_real_escape_string($con, $nombre);
                $apellidos = mysqli_real_escape_string($con, $apellidos);
                $correo = mysqli_real_escape_string($con, $correo);
                $contrasenia = mysqli_real_escape_string($con, $contrasenia);

                //INSERT
                $insert = mysqli_query($con, 'INSERT INTO usuarios values(null, "'.$nombre.'", "'.$apellidos.'", "'.$correo.'", "'.$contrasenia.'", CURRENT_TIMESTAMP());');
                if($insert){
                    echo "<h1>Usuario registrado con exito!</h1><br>";
                }else{
                    //GESTION DE CORREO REPETIDO
                    $_SESSION["correo_existe"] = true;
                    header('Location: index.php');
                }
                
            }else{
                echo "Error en la conexion";
            }
        }
    }

?>
<?php
    /*
    ESTA PAGINA REALIZA:
        INSERCION DE USUARIOS (REGISTRO)
    */

    include '../modules/utilities.php';
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        //VALIDACION NOMBRE
        $nombre = limpiaChar($_REQUEST["nombre"]);
        if(empty($nombre) || preg_match('/[^a-z A-Z0]/', $nombre)){
            $_SESSION["error_nombre"] = true;
        }

        //VALIDACION APELLIDOS
        $apellidos = limpiaChar($_REQUEST["apellidos"]);
        if(empty($apellidos) || preg_match('/[^a-z A-Z0]/', $apellidos)){
            $_SESSION["error_apellidos"] = true;
        }

        //VALIDACION CORREO
        $correo = limpiaChar($_REQUEST["correo"]);
        if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $_SESSION["error_correo"] = true;
        }

        //VALIDACION CONTRASEÑA
        $contrasenia = limpiaChar($_REQUEST["contrasenia"]);
        if(empty($contrasenia) || preg_match('/[^a-zA-Z0-9_\-!¡?¿+*]/', $contrasenia)){
            $_SESSION["error_contrasenia"] = true;
        }


        //COMPRUEBA QUE NO HAYA ERRORES EN LOS CAMPOS
        if(isset($_SESSION["error_nombre"]) || isset($_SESSION["error_apellidos"]) || isset($_SESSION["error_correo"]) || isset($_SESSION["error_contrasenia"])){
           header('Location: ../index.php');
        }else{
            $con = 'mysql:dbname=proyecto1;host=localhost;charset=utf8';
            try{
                $db = new PDO($con, 'fer', 'root');

                //ENCRIPTAMOS LA CONTRASEÑA
                $contrasenia = password_hash( $contrasenia, PASSWORD_BCRYPT, ['cost'=>4]);

                //INSERCION
                $ins = $db->prepare("INSERT into usuarios VALUES(null, :nombre, :apellidos, :correo, :contrasenia, CURRENT_TIMESTAMP())");
                $ins->bindValue(':nombre', $nombre, PDO::PARAM_STR);
                $ins->bindValue(':apellidos', $apellidos, PDO::PARAM_STR);
                $ins->bindValue(':correo', $correo, PDO::PARAM_STR);
                $ins->bindValue(':contrasenia', $contrasenia, PDO::PARAM_STR);
                $ins->execute();
                if($ins){
                    //REGISTRO CON EXITO
                    $_SESSION['sign_in'] = 1;
                    header('Location: ../index.php');
                }else{
                    //GESTION DE CORREO REPETIDO
                    $_SESSION["correo_existe"] = 1;
                    header('Location: ../index.php');
                }
        
                $db = NULL;
                unset($db);
            }catch(PDOException $e){
                echo 'Error al conectar con la base de datos ' . $e->getMessage();
                echo "<a href='../index.php'>Volver al inicio</a>";
            }
        }
    }

?>
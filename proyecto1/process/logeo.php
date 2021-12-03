<?php
    /*
    ESTA PAGINA REALIZA:
        INICIO DE SESION (LOGEO)
    */

    include '../modules/utilities.php';
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        //VALIDACION CORREO
        $correo = limpiaChar($_REQUEST["correo"]);

        //VALIDACION CONTRASEÑA
        $contrasenia = limpiaChar($_REQUEST["contrasenia"]);
        

        $con = 'mysql:dbname=proyecto1;host=localhost;charset=utf8';
        try{
            $db = new PDO($con, 'fer', 'root');

            //COMPRUEBA QUE EXISTA EL CORREO
            $select = $db->prepare('SELECT password FROM usuarios where email=:correo');
            $select->bindValue(':correo', $correo);
            $select->execute();
            //SI SE DEVUELVE UNA LINEA EXISTE UNA CUENTA CON ESE CORREO
            if($select->rowCount() == 1){
                //SE COMPRUEBA QUE LA CONTRASEÑA COINCIDA CON EL CORREO
                if(password_verify($contrasenia, $select->fetch(PDO::FETCH_ASSOC)['password'])){
                    //SE HA LOGEADO CORRECTAMENTE Y SE CREA LA SESION
                    $_SESSION["log_in"] = $correo;
                    header('Location: ../index.php');
                }else{
                    //ERROR EN LAS CREDENCIALES
                    $_SESSION["error_credenciales"] = 1;
                    header('Location: ../index.php');
                }
            }else{
                //NO EXISTE EL CORREO
                $_SESSION["correo_no_registrado"] = 1;
                header('Location: ../index.php');
            }

            $db = NULL;
            unset($db);
        }catch(PDOException $e){
            echo 'Error al conectar con la base de datos ' . $e->getMessage();
            echo "<br><a href='../index.php'>Volver al inicio</a>";
        }
    }

?>
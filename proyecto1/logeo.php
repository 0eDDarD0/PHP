<?php
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        function quitarCaracteres($a){
            return stripslashes(trim(htmlspecialchars($a)));
        }
        //VALIDACION CORREO
        $correo = quitarCaracteres($_REQUEST["correo"]);
        //VALIDACION CONTRASEÑA
        $contrasenia = quitarCaracteres($_REQUEST["contrasenia"]);


        $con = @mysqli_connect('localhost', 'fer', 'root', 'proyecto1');
        if(!mysqli_connect_errno()){
            mysqli_query($con, "SET NAME 'utf-8'"); //nos aseguramos de que la codificacion sea utf 8
            $correo = mysqli_real_escape_string($con, $correo); //escapamos el correo ya que va a ser introducido en una query

            //COMPRUEBA QUE EXISTA EL CORREO
            $select = mysqli_query($con, 'SELECT password FROM usuarios where email="'.$correo.'";');
            //SI SE DEVUELVE UNA LINEA EXISTE UNA CUENTA CON ESE CORREO
            if($select && mysqli_num_rows($select) == 1){
                //COMPROBAMOS QUE LA CONTRASEÑA INTRODUCIDA COINCIDE CON EL HASH DE LA QUERY
                if(password_verify($contrasenia, mysqli_fetch_assoc($select)['password'])){
                    //SE HA LOGEADO CORRECTAMENTE Y SE CREA LA SESION
                    $_SESSION["log_in"] = $correo;
                    header('Location: index.php');

                }else{
                    //ERROR EN LAS CREDENCIALES
                    $_SESSION["error_credenciales"] = 1;
                    header('Location: index.php');
                }
            }else{
                //NO EXISTE EL CORREO
                $_SESSION["correo_no_registrado"] = 1;
                header('Location: index.php');
            }
            
        }else{
            echo "Error en la conexion";
        }
    }

?>
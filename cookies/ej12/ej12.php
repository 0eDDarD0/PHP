<?php
    session_start();

    if(isset($_REQUEST["other"])){  //compruebo si se ha pedido un login distinto, si se pide...
        if($_REQUEST["other"] == 1){
            setcookie($_SESSION["login"], "", 1);   //destruyo la cookie
            session_destroy();                      //destruyo la sesion
            header('Location: ej12.php');           //recargo la pagina
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){   //compruebo si se ha entrado por formulario
        if($_REQUEST["user"] == "usuario" && $_REQUEST["password"] == "1234"){  //verifico los credenciales
            setcookie($_REQUEST["user"], $_REQUEST["password"], time() + 60 * 60 * 24 * 365);   //creo la cookie
            $_SESSION["login"] = $_REQUEST["user"];     //indico que la sesion pertenece al usuario logeado
            if(isset($_REQUEST["remember"])){           //si se ha marcado que se le recuerde se indica en la sesion
                $_SESSION["remember"] = true;
            }else{
                $_SESSION["remember"] = false;
            }
            header('Location: logeado.php');    //nos redirige al contenido
        }else{
            echo '<p style="color:red;">usuario o contraseña incorrectos</p>';
        }
    }

    if(isset($_SESSION["remember"])){   //si se debe recordar al usuario incializamos las variables para los value de los input
        $user = $_SESSION["remember"] ? $_SESSION["login"] : "";   
        $password = $_SESSION["remember"] ? $_COOKIE[$_SESSION["login"]] : "";
    }else{
        $user = "";
        $password = "";
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
    
    <h1>Inicio de sesión</h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="user">Usuario<br>
            <input type="text" name="user" id="user" value="<?php echo $user ?>">
        </label><br>
        <label for="password">Contraseña<br>
            <input type="password" name="password" id="password" value="<?php echo $password ?>">
        </label><br>
        <input type="submit" value="Iniciar Sesión"><br>
        <input checked type="checkbox" name="remember" id="remember">Recordarme en este equipo
    </form>
        <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?other=1"; ?>">Iniciar Sesión con otra cuenta</a>

</body>
</html>
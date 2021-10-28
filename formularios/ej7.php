<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> method="post">
        <!-- <label for="anio">Año de nacimiento:
            <input type="text" name="anio">
        </label><br>
        <label for="dia">Dia
            <input type="text" name="dia">
        </label><br>
        <label for="mes">Mes
            <input type="text" name="mes">
        </label><br> -->
        <label for="f">Nacimiento
            <input type="date" name="f">
        </label><br>
        <input type="submit">
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $fecha = explode("-", $_POST["f"]);
            $hoy = explode("-", date("Y-m-d"));
            echo $fecha[0] . " " . $hoy[0] . "<br>";
            $anios = 0;
            if($fecha[1] >= $hoy[1]){
                if($fecha[2] >= $hoy[2])
                    $anios = $hoy[0] - $fecha[0];
                    echo $anios;
            }else{
                $anios = (int)($hoy[0] - $fecha[0]) - 1;
                echo $anios;
            }

            if($anios >= 85){
                echo "Eres muy viejo para este local";
            }else if($anios < 18){
                echo "A dormir chiquitin";
            }else{
                echo "Pase";
            }
        }
    ?>
</body>
</html>
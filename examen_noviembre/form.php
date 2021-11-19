
<form enctype="multipart/form-data" action="output.php" method="post" name="inmobiliaria">
        Tipo de vivienda:<br>
        <input type="radio" name="tipo" value="casa">casa
        <input type="radio" name="tipo" value="piso">piso
        <input type="radio" name="tipo" value="duplex">duplex<br>


        <br>Zona:<br>
        <input type="radio" name="zona" value="Centro">Centro
        <input type="radio" name="zona" value="Albaicín">Albaicín
        <input type="radio" name="zona" value="Sacromonte">Sacromonte
        <input type="radio" name="zona" value="Realejo">Realejo
        <input type="radio" name="zona" value="Chana">Chana
        <input type="radio" name="zona" value="zaidin">Zaidin<br>


        <br>Dirección:<br>
        <input type="text" name="direccion"><br>


        <br>Numero de dormitorios:<br>
        <input type="radio" name="num" value="1">1
        <input type="radio" name="num" value="2">2
        <input type="radio" name="num" value="3">3
        <input type="radio" name="num" value="4">4
        <input type="radio" name="num" value="5">5<br>
 

        <br>Precio:<br>
        <input type="text" name="precio">€<br>


        <br>Tamaño:<br>
        <input type="text" name="tamanio">metros cuadrados<br>


        <br>Extras (marque los que procedan):<br>
        Piscina
        <input type="checkbox" name="extras[]" value="piscina"><br>
        Jardin
        <input type="checkbox" name="extras[]" value="jardin"><br>
        Garaje
        <input type="checkbox" name="extras[]" value="garaje"><br>


        <br>Foto:<br>
        <input type="file" name="imagen" id="imagen"><br>


        <br>Observaciones:<br>
        <input type="textarea" name="observaciones"><br>


        <br><input type="submit">
    </form>
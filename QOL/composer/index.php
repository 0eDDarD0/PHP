<?php
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Faker\Factory;
use Faker\Provider\es_ES\Payment;
use Picqer\Barcode\BarcodeGeneratorHTML;

//CREAMOS UNA CADENA CON EL HTML QUE SERA CONVERTIDO A PDF
$f = Factory::create('es_ES');
$html = "<body style='border:1px solid black; padding:10px;'>";

//CABECERA
$html .= "<h1>Banco SFLL</h1><hr>";
$html .= "<h2>Datos del cliente</h2>";
//NOMBRE
$html .= "<h4>Nombre</h4>";
$html .= $f->firstName() . " " . $f->lastName() . " " . $f->lastName();
//IBAN
$html .= "<br><br><h4>Numero de cuenta</h4>";
$html .= $f->bankAccountNumber();
//DNI
$html .= "<br><br><h4>DNI</h4>";
$html .= $f->dni();
//CODIGO DE BARRAS
$html .= "<div style='height: 550px;'></div>";
$generator = new BarcodeGeneratorHTML();
$html .= $generator->getBarcode($f->ean13(), $generator::TYPE_CODE_128);
//CERRAMOS HTML
$html .= "</body>";


//PASAMOS LA CADENA DE HTML A DOMPDF 
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4');
$dompdf->render();
$dompdf->stream();

?>
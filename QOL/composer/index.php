<?php
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Faker\Factory;

//CREAMOS UNA CADENA CON EL HTML QUE SERA CONVERTIDO A PDF
$f = Factory::create();
$color = $f->hexColor();
$html = "<body style='border:1px solid black; padding:10px; background-color:".$color.";'>";

$html .= "<h1>Nombre:</h1>";
$html .= $f->name();
$html .= "<h1>Correo:</h1>";
$html .= $f->email();
$html .= "<h1>Teléfono:</h1>";
$html .= $f->randomNumber(9, true);
//cerramos html
$html .= "</body>";


//PASAMOS LA CADENA A DOMPDF 
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4');
$dompdf->render();
$dompdf->stream();

?>
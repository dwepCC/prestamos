<?php
//ob_end_clean();
//flush();
//ob_start();
//header("Content-type: application/pdf"); 
//ini_set ('display_errors', 1);
//activamos almacenamiento en el buffer
//ob_start();
if (strlen(session_id())<1) 
session_start();

if (!isset($_SESSION['nombre'])) {
  echo "debe ingresar al sistema correctamente para visualizar el reporte";
}else{

if ($_SESSION['prestamos']==1) {

//require_once "../../Models/Company.php";
//include_once(dirname(__FILE__,2) . '\Models\Company.php');
$test= __DIR__ . '/' . '\Models\Company.php';

class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

$idcredito = $this->codigo;

$digito_num = 5;
$num_pagare = substr(str_repeat(0, $digito_num).$idcredito, - $digito_num);
//REQUERIMOS LA CLASE TCPDF
require_once('tcpdf_include.php');

// create new PDF document
$pageLayout = array(210,297); //  or array($height, $width) 
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $pageLayout, true, 'UTF-8', false);
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default header data
/*$PDF_HEADER_LOGO = "logo.jpg";//any image file. check correct path.
$PDF_HEADER_LOGO_WIDTH = "50";
$PDF_HEADER_TITLE = "www.lamarperu.com";
$PDF_HEADER_STRING = 'Telf:   Direc: ';
$pdf->SetHeaderData($PDF_HEADER_LOGO, $PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);*/

$pdf->SetHeaderData('', PDF_HEADER_LOGO_WIDTH, 'marks', 'header string');

$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, 20, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


$pdf->setFontSubsetting(true);


$pdf->startPageGroup();

$pdf->setPrintHeader(false); //no imprime la cabecera ni la linea
$pdf->setPrintFooter(true); //no imprime el pie ni la linea

$pdf->AddPage();

// ---------------------------------------------------------

$pdf->SetFont ("", "", 9 , "", "default", true );
$bloque1 = <<<EOF
<div style="text-align: center;"><u><b>PAGARE N: $num_pagare</b></u></div>
<div style="text-align: right;"><b>IMPORTE DEUDOR</b>:.....................................</div>
<div><b>IMPORTE ORIGINAL</b>:.....................................
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Vence el.................. de................................del 20...........</div><br><br>
EOF;

//$pdf->writeHTML($bloque2, false, false, false, false, '');
$pdf->writeHTML($bloque1, true, 0, true, true);
$pdf->SetFont ("", "", 8 , "", "default", true );
$bloque2 = <<<EOF
<div style="text-align: justify;">
Yo (nosotros).........................................................................................................................................................................................................................
<br><br>
Reconozco (reconocemos) que adeudo (adeudamos) y pagar?? (pagaremos) incondicionalmente  en la fecha del vencimiento consignado en el presente Pagar??,  a la orden del se??or: Julio Cesar Tunquipa Mamani, Identificado con DNI: 70130725 denominada en adelante <b>EL ACREEDOR</b>, o a quien esta se lo hubiera cedido, en su domicilio o donde se presentara para su cobro; en importe de........................................................................................................(....................................), sin lugar a reclamo de clase alguna para cuyo fiel y exacto cumplimiento, me obligo con todos mis bienes presentes y futuros en la mejor forma de derecho, al efecto, asumo la obligaci??n en las siguientes condiciones:<br>

<div style="text-align: center;"><u><b>CLA??SULAS  ESPECIALES</b></u></div>
<u><b>PRIMERO:</b></u>   Este pagare ser?? pagado en la misma moneda que expresa este t??tulo de valor por ser producto de un pr??stamo de dinero otorgado por <b>EL ACREEDOR</b>.<br>
<u><b>SEGUNDO:</b></u>   Quedan aceptadas todas las renovaciones y prorrogas del vencimiento de este Pagar??; que <b>EL ACREEDOR</b> pudiera otorgar, sin que sea necesaria intervenci??n alguna del obligado principal ni de los avalistas solidarios.<br>
<u><b>TERCERO:</b></u>   El pago del importe del Pagar??, podr?? ser pactado en una o m??s cuotas, seg??n el/los importe(s) y vencimiento que indique el correspondiente cronograma de pagos que no requerir?? de suscripci??n adicional al presente documento.<br>
<u><b>CUARTO:</b></u>  El importe de este pagar?? y/o de las cuotas de cr??dito que representa, genera desde la fecha de emisi??n hasta la fecha de sus respectivo(s) vencimiento(s). un inter??s compensatorio que se pacta en la tasa efectiva de ...........% anual y una tasa de inter??s moratorio efectivo de ..........% anual.<br>
<u><b>QUINTO:</b></u>  En caso de incumplimiento en el pago de una o m??s cuotas pactada, al importe deudor se le aplicaran los intereses compensatorios e intereses moratorios conforme a las tasas m??ximas aprobadas por el acreedor desde la fecha de vencimiento hasta su total cancelaci??n, sin que sea necesario efectuar el requerimiento previo de pago para constituir en mora al obligado principal ni a los avalistas solidarios incurri??ndose en esta autom??ticamente, por el solo hecho del vencimiento. Siendo de aplicaci??n en este caso lo dispuesto por el Art. 158.2 de la ley de t??tulos valores.<br>
<u><b>SEXTO:</b></u>  El cliente y su conyugue o conviviente obligados principales y los deudores solidarios aceptan igualmente que las tasas de inter??s compensatorio y/o moratorio pueden ser variados por <b><b>EL ACREEDOR</b></b> o su tenor, sin necesidad de aviso previo, de acuerdo a las tasas que este tenga vigentes de conformidad a lo establecido en el Art. 1243 del C??digo Civil.<br>
<u><b>SEPTIMO:</b></u> Las obligaciones principales y solidarios suscribientes del pagare, dejan constancia que este documento no est?? sujeto a protesto por falta de pago, salvo lo disponga en el art??culo 81.2 de la ley 27287 y sus normas complementarias.<br>
<u><b>OCTAVO:</b></u>   Ser??n de cargo de los obligados principales y avalistas solidarios, el pago del integro de los tributos, y gastos que afecten a este pagare o a la obligaci??n en el contenida, los mismos que ser??n calculados y determinados por <b>EL ACREEDOR</b>, o su tenor en la oportunidad en que ello se verifique.<br>
<u><b>NOVENO:</b></u> El o los obligado (s) principal (es) y los avalistas solidarios autorizan desde ya expresamente a <b>EL ACREEDOR</b> a cargar directamente en sus cuentas (sea en moneda nacional y/o extranjera) que mantengan en ella, el saldo deudor del cr??dito que presenta el pagare, as?? como a compensarlos con cualquier otro tipo de bien que pudiera tener en su poder, sin que ello obligue o signifique responsabilidad para <b>EL ACREEDOR</b>.<br>
<u><b>DECIMO:</b></u> El presente pagar?? ser?? ejecutado por el solo m??rito de haberse dado por vencido su plazo, no estando sujeto a protesto, al haberse optado por la preclusi??n de los plazos de ser el caso, seg??n lo pactado al amparo de lo establecido en el Art. 10 de la ley de T??tulos de Valores.<br>
<u><b>DECIMO PRIMERO:</b></u> El presente pagar?? ser?? ejecutado por el solo m??rito de haberse dado por vencido su plazo, no estando sujeto a protesto, al haberse optado por la preclusi??n de los plazos de ser el caso, seg??n lo pactado al amparo de lo establecido en el Art. 10 de la ley de T??tulos de Valores.<br>
<u><b>DECIMO SEGUNDO:</b></u> <b>EL ACREEDOR</b> o su tenor podr?? entablar acci??n judicial para efectuar el cobro de este Pagar??, procedimiento previamente conforme los acuerdos adoptados, donde lo tuviera por conveniente, a cuyo efecto el obligado principal y los avalistas solidarios renuncian el fuero de su propio domicilio y a cuantos favorecerles en el proceso judicial o fuera de ??l, se??alando como domicilio, para todo los efectos y consecuencias que pudieran derivarse de la emisi??n del presente pagar??, el indicado en este documento, lugar donde se env??an los avisos y se har??n llegar todas las comunicaciones y/o notificaciones judiciales que resulten necesarias, para lo cual se sometan expresamente a las leyes de la Rep??blica del Per?? y la competencia de los jueces y sala de distrito judicial de la ciudad donde se suscribe el presente Pagar??.<br>
..........................................................., .............de................................................del.................<br><br><br>
</div>
EOF;

//$pdf->writeHTML($bloque2, false, false, false, false, '');
$pdf->writeHTML($bloque2, true, 0, true, true);
//"<div style='text-align: justify;'".$bloque2."</div>"
// ---------------------------------------------------------

$bloque3 = <<<EOF
<div><p>
FIRMA:____________________________________________________&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;FIRMA:____________________________________________________<br>
Deudor / Representante Legal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
C??nyuge / Codeudor<br><br>

Nombre y apellido/Raz??n social: ________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Nombre y apellido/Raz??n social: ________________________________<br><br>

__________________________________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
__________________________________________________________<br><br>
DNI/RUC: __________________________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
DNI/RUC: __________________________________________________<br><br>
Direcci??n: __________________________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Direcci??n: __________________________________________________<br><br>

__________________________________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
__________________________________________________________<br><br>
</p></div>
EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------


$bloque4 = <<<EOF
<div style="text-align: justify;">
AVAL: Los que suscribimos al final nos constituimos en avalistas SOLIDARIOS con los deudores y entre nosotros mismos, renunciando expresamente al beneficio de excusi??n, por todas las obligaciones que se contraen por el presente pagar?? comprometi??ndose a responder por la cantidad adeudada, los intereses compensatorios y monetarios de ser el caso y comisi??n pactada que se devengas4e seg??n lo estipulado, as?? como los tributos, gastos notariales, costas y costos procesales a que hubiera lugar. As?? mismo expresamos nuestra aceptaci??n a las condiciones especiales de giro de este t??tulo valor. Dejamos constancia que esta FIANZA SOLIDARIA la constituimos por plazo indeterminado hasta que sea ??ntegramente cancelada la obligaci??n a la que se sirve de garant??a, renunciando en forma expresa al plazo de requerimiento al que se refiere el art. 1899 del C.C ACEPTANDO DESDE AHORA TODAS LAS PRORROGAS Y RENOVACIONES que se conceda a los deudores para los cuales prestamos nuestro consentimiento expreso sin que sean necesarias nuevamente nuestras firmas en las anotaciones que sobre el particular se hagan en este mismo documento todo ello con arreglo a las disposiciones del Art. 1901 del C.C nos sometemos a jurisdicci??n se??alada por el girador y se??alamos como nuestros domicilios para todos los fines de actos notariales y/o procesales, los se??alados en el presente documento.<br><br>
........................................, ................. De......................................del 20..........
</div>
<div><p>
FIRMA:____________________________________________________&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;FIRMA:____________________________________________________<br>
Avalista &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Avalista C??nyugue o Conviviente<br><br>

Nombre y apellido/Raz??n social: ________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Nombre y apellido/Raz??n social: ________________________________<br><br>

__________________________________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
__________________________________________________________<br><br>
DNI/RUC: __________________________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
DNI/RUC: __________________________________________________<br><br>
Direcci??n: __________________________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Direcci??n: __________________________________________________<br><br>

__________________________________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
__________________________________________________________<br><br>
</p></div>
<div><p>
FIRMA:____________________________________________________&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;FIRMA:____________________________________________________<br>
Avalista &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Avalista C??nyugue o Conviviente<br><br>

Nombre y apellido/Raz??n social: ________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Nombre y apellido/Raz??n social: ________________________________<br><br>

__________________________________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
__________________________________________________________<br><br>
DNI/RUC: __________________________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
DNI/RUC: __________________________________________________<br><br>
Direcci??n: __________________________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Direcci??n: __________________________________________________<br><br>

__________________________________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
__________________________________________________________<br><br>
</p></div>
EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');


$bloque5 = <<<EOF
<div><p>
RENOVADO POR:.....................................................................................&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
RENOVADO POR:.....................................................................................<br><br>

VENCIMIENTO AL ....................................................................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
VENCIMIENTO AL ....................................................................................<br><br>

DE CONFORMIDAD A LOS TERMINOS DE ESTE DOCUMENTO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
DE CONFORMIDAD A LOS TERMINOS DE ESTE DOCUMENTO<br><br>
FECHA:......................................................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
FECHA:......................................................................<br><br><br><br><br><br><br><br>

</p><br><br></div>

<div><p>
<b>_____________________________________________________</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
<b>_____________________________________________________</b><br><br>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>GERENTE</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>GERENTE</b> <br><br>

</p></div>
EOF;
//$pdf->SetXY(0, 250);
$pdf->writeHTML($bloque5, false, false, false, false, '');



// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 


ob_end_clean();
$pdf->Output('pagare.pdf', 'I');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["id"];
$factura -> traerImpresionFactura();

}else{
echo "No tiene permiso para visualizar el reporte";
}

}

ob_end_flush();
?>
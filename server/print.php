<?php
require('pdf/pdf_js.php');


class PDF_AutoPrint extends PDF_JavaScript
{
function AutoPrint($dialog=false)
{
	//Open the print dialog or start printing immediately on the standard printer
	$param=($dialog ? 'true' : 'false');
	$script="print($param);";
	$this->IncludeJS($script);
}

function AutoPrintToPrinter($server, $printer, $dialog=false)
{
	//Print on a shared printer (requires at least Acrobat 6)
	$script = "var pp = getPrintParams();";
	if($dialog)
		$script .= "pp.interactive = pp.constants.interactionLevel.full;";
	else
		$script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
	$script .= "pp.printerName = '\\\\\\\\".$server."\\\\".$printer."';";
	$script .= "print(pp);";
	$this->IncludeJS($script);
}
}


$pdf=new PDF_AutoPrint();
$pdf->AddPage('L');
$pdf->SetFont('Times','',20);

$pdf->Text(90, 50, 'Print medadasdadasda!');
//cell(width,height,text,border,endline,la lalign)
$pdf->Cell(60,10,'Image',1,0);
$pdf->Cell(60,10,'Name',1,0);
$pdf->Cell(60,10,'Nickname',1,0);
$pdf->Cell(60,10,'Date Created',1,0);
$pdf->Cell(60,10,'Status',1,0);//end of line		

//Open the print dialog
$pdf->AutoPrint(true);
$pdf->Output();

?>

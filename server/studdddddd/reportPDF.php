<?php 
session_start();
include '../connect.php';

require('../pdf/fpdf.php');

class PDF extends FPDF{

function FancyTable(){

$this->SetFillColor(255,0,0,0);	
$this->SetTextColor(255);
$this->SetDrawColor(128,0,0);
$this->SetLineWidth(.3);
$this->SetFont('Arial','B',10);

	$this->Cell(5,7,"No.",1,0,'C',True);
	$this->Cell(20,7,"First Name",1,0,'C',True);
	$this->Cell(20,7,"Last Name",1,0,'C',True);
	$this->Cell(20,7,"Email",1,0,'C',True);
	$this->Cell(10,7,"Gender",1,1,'C',True);
	
	}
}
$pdf = new PDF();
$pdf->AddPage();
$pdf->FancyTable();
$pdf->Output();
?>
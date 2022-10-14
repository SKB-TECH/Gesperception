<?php

    require_once("../../Classes/crud.php");
    $db = new crud();
    require('fpdf/fpdf.php');
class myPDF extends FPDF {
    function footer(){    
        $this->Sety(-19);
        $this->SetFont('Arial','',10);
        $this->Cell(0,10,'Page '.$this->PageNo().' sur {nb}',0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','',10);
         }
    function Table($db){
        $this->SetFont('Arial','B',14);
        $this->cell(170,2,'INSITUT NYALUKEMBA',0,0,'C');
        $this->Ln();
        // $this-> Image('juwa.jpg',240,10,25,25);
        // $this-> Image('juwa.jpg',40,10,25,25);
        $this->SetFont('Times','B',12);
       
        $this->Ln(4);
        $this->cell(170,6,utf8_decode('Salaire du mois  '),0,0,'C');
        $this->Ln();
     
         //Fin En-tête page 
    }
    //entete du tableau

    function headerTable(){
        $this->SetFont('courier','',11);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(10,7,utf8_decode('N°'),1,0,'C', true);
        $this->Cell(50,7,'Motif',1,0,'C', true);
        $this->Cell(30,7,utf8_decode('Montant'),1,0,'C', true);
        $this->Cell(30,7,utf8_decode('UM'),1,0,'C', true);
        $this->Cell(20,7,utf8_decode('Date'),1,0,'C', true);
        
    }
    function vieTable($db){
        $i = 0;
        $debut = $_POST['debut'];
        $fin = $_POST['fin'];
        $res=$db->selectalldata2("SELECT  * FROM depense where dates BETWEEN '$debut' and '$fin'");
        while($data = $res->fetch()){
            $i++;
            $this->SetFont('times','',12);
            $this->SetFillColor(255, 255, 255);
            $this->Cell(10,7,utf8_decode($i),1,0,'C', true);
            $this->Cell(50,7,$data['motif'],1,0,'L', true);
            $this->Cell(30,7,$data['montant'],1,0,'C', true);
            $this->Cell(30,7,$data['um'],1,0,'C', true);
            $this->Cell(20,7,$data['dates'],1,0,'C', true);
            $this->Ln();
        }
     }
function Totalite(){ 

$this->SetFillColor(3, 1, 10);
$this->Setx(27);
$this->Ln();     
        }
  
}
$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4',0);
$pdf->Table($db);
$pdf->Ln(7);
$pdf->headerTable();
$pdf->Ln(7);
$pdf->vieTable($db);
$pdf->Ln(5);
$pdf->Totalite($db);
$pdf->Ln(5);
$pdf->Cell(250,5,utf8_decode("Fait à Bukavu le ").date('d/m/Y'),0,0,'C');
$pdf->Ln(5);
$pdf->Cell(100,10,'',0,0);
$pdf->Cell(50,5,utf8_decode("Nom et Signature"),0,1,'C');
$pdf->Output();
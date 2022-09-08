<?php
    
    session_start();

    require('../fpdf/fpdf.php');
    require('../connexion.php');
class myPDF extends FPDF {
    function footer(){    
        $this->Sety(-19);
        $this->SetFont('Arial','',10);
        $this->Cell(0,10,'Page '.$this->PageNo().' sur {nb}',0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','',10);
         }
    function Table($pdo){
        
         $annee = $_SESSION['user']['anneeAcademique'];
        $this->SetFont('Arial','',14);
        $this->cell(195,6,'REPUBLIQUE DEMOCRATIQUE DU CONGO',0,0,'C');
        $this->Ln();
        $this-> Image('../assets/images/logo/logo.png',170,10,17,17);
        $this-> Image('../assets/images/logo/logo2.png',25,10,17,17);
        $this->SetFont('Times','',14);
        $this->cell(195,6,utf8_decode('INSTITUT SUPERIEUR DE COMMERCE D\'UVIRA'),0,0,'C');
        $this->Ln();
        $this->cell(195,6,utf8_decode('I.S.C-UVIRA'),0,0,'C');
        $this->Ln();
        $this->SetFillColor(3, 1, 10);
        $this->Setx(10);
        $this->Cell(189,1,'',0,0,'L', true);
        $this->Ln(3);
        $this->cell(195,6,utf8_decode('LISTE DES SECRETAIRES'),0,0,'C');
        $this->Ln();
        $this->cell(195,6,utf8_decode("Annee academique : ".$annee),0,0,'C');
        $this->Ln(9);
        $this->SetFillColor(3, 1, 10);
        $this->Setx(10);
        $this->Cell(189,1,'',0,0,'L', true);
        $this->Ln();
         //Fin En-tête page 
    }
    //entete du tableau

    function headerTable(){
        $this->SetFont('courier','B',12);
        $this->SetFillColor(209, 206, 206);
        $this->Cell(30,7,utf8_decode('N°'),1,0,'C', true);
        $this->Cell(80,7,'NOM ET POST-NOM',1,0,'C', true);
        $this->Cell(20,7,'Section',1,0,'C', true);
        $this->Cell(30,7,utf8_decode('DEPARTEMENT'),1,0,'C', true);
        $this->Cell(25,7,utf8_decode('PROMOTION'),1,0,'C', true);
    }
    function vieTable($pdo){
       
        $annee = $_SESSION['user']['anneeAcademique'];
        $res=$pdo->query("SELECT idSec,nomSec,promotion.designation as promotion,departement.designation as departement, section.designation as section 
        FROM secretaire
        INNER JOIN promotion ON secretaire.promotion = promotion.idPromotion
        INNER JOIN departement ON departement.idDepartement = promotion.idDepartement
        INNER JOIN section ON section.idSection = departement.idSection");
        while($sec = $res->fetch()){
            $this->SetFont('courier','B',12);
            $this->SetFillColor(209, 206, 206);
            $this->Cell(30,7,utf8_decode($sec['idSec']),1,0,'C', true);
            $this->Cell(80,7,$sec['nomSec'],1,0,'C', true);
            $this->Cell(20,7,$sec['section'],1,0,'C', true);
            $this->Cell(30,7,$sec['departement'],1,0,'C', true);
            $this->Cell(25,7,$sec['promotion'],1,0,'C', true);
            $this->Ln();
        }
    }
function Totalite(){ 
$this->Ln(6);
$this->Cell(0,0,utf8_decode("Date d'impression : ").date('d/m/Y'),0,0,'L');
$this->Ln(6);
$this->Cell(0,0,utf8_decode("Heure d'impression : ").date('H:i:s'),0,0,'L');
$this->Ln(6);
$this->SetFillColor(3, 1, 10);
$this->Setx(27);
$this->Cell(150,1,'',1,0,'L', true);
$this->Ln();     
        }
  
}
$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4',0);
$pdf->Table($pdo);
$pdf->Ln(7);
$pdf->headerTable();
$pdf->Ln(7);
$pdf->vieTable($pdo);
$pdf->Ln(5);
$pdf->Totalite($pdo);
$pdf->Ln(5);
$pdf->Cell(280,5,utf8_decode("Fait à Bukavu le ").date('d/m/Y'),0,0,'C');
$pdf->Ln();
$pdf->Cell(100,10,'',0,0);
$pdf->Cell(75,6,utf8_decode("Nom et Signature"),0,1,'C');
$pdf->Output();
<?php
    
    require("session.php");

    require('../fpdf/fpdf.php');
    require('connexion.php');
class myPDF extends FPDF {
    function footer(){    
        $this->Sety(-19);
        $this->SetFont('Arial','',10);
        $this->Cell(0,10,'Page '.$this->PageNo().' sur {nb}',0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','',10);
         }
    function Table($pdo){
        
       
        $this->SetFont('Arial','B',20);
        $this->cell(195,6,'Action Juwa ASBL',0,0,'C');
        $this->Ln();
        $this-> Image('juwa.jpg',170,10,17,17);
        $this-> Image('juwa.jpg',25,10,17,17);
        $this->SetFont('Times','B',14);
       
        $this->Ln(3);
        $this->cell(195,6,utf8_decode('LISTE GENERALE DES DETTES NON REGLEES '),0,0,'C');
        $this->Ln(10);
       
         //Fin En-tête page 
    }
    //entete du tableau

    function headerTable(){
        $this->SetFont('times','',10);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(10,7,utf8_decode('N°'),1,0,'C', true);
        
        $this->Cell(55,7,'Noms',1,0,'C', true);
        
        $this->Cell(15,7,utf8_decode('Code'),1,0,'C', true);
        $this->Cell(20,7,'Tel',1,0,'C', true);
        $this->Cell(25,7,utf8_decode('Date'),1,0,'C', true);
        $this->Cell(20,7,utf8_decode('Montant'),1,0,'C', true);
         $this->Cell(20,7,utf8_decode('Reste'),1,0,'C', true);
         $this->Cell(20,7,utf8_decode('Solde'),1,0,'C', true);
        
    }
    function vieTable($pdo){
        $i = 0;
        
        $res=$pdo->query("SELECT  * FROM dettes 
            inner join clients on clients.code_client = dettes.client 
            inner join user on user.code_user = dettes.idAgent and obs = 0 order by date_dette desc");
        while($data = $res->fetch()){
            $i++;
            $this->SetFont('times','',11);
            $this->SetFillColor(255, 255, 255);
            $this->Cell(10,7,utf8_decode($i),1,0,'C', true);
            $this->Cell(55,7,$data['noms_client'],1,0,'L', true);
            $this->Cell(15,7,utf8_decode($data['code_client']),1,0,'C', true);
            $this->Cell(20,7,$data['numero_telephone'],1,0,'L', true);
            $this->Cell(25,7,$data['date_dette'],1,0,'C', true);
            $idDette = $data['code_dettes'];
            $res4 = $pdo->query("SELECT codeEmprunt from recouvrements");
            $test_array = [];
            while($data5 = $res4->fetch()){
            	array_push($test_array, $data5['codeEmprunt']); 	
            }
        	  $reste = $data['montant'];
                 if(in_array($idDette, $test_array)){
                      $res6 =  $pdo->query("SELECT sum(montant) as rec  from recouvrements where codeEmprunt='$idDette'");
                      $data10 = $res6->fetch();
                     $reste = $data['montant'] - $data10['rec'];
                 } 

            $this->Cell(20,7,$data['montant'],1,0,'C', true);
            $this->Cell(20,7,$reste,1,0,'C', true);
            $this->Cell(20,7,$data['montant'] - $reste,1,0,'C', true);
            $this->Ln();
            $somme += $reste;
        }
        $this->Cell(125,7,"TOTAL DES DETTES  ",1,0,'C', true);
        $this->SetFont('times','B',12);
        $this->Cell(60,7,$somme." FC",1,0,'C', true);
            
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

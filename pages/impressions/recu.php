 <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    include("./phpqrcode/qrlib.php");
    require_once("../../Classes/crud.php");
    $db = new crud();
    // $idRec = 2;
    $idRec = $_GET['idRec'];
    // recherche le paiement a imprimer
    $resultat = $db->selectalldata2("select * from perception 
                    inner join frais on idFrais = frais.id
                    inner join eleves on eleves.id=idEleve  and perception.id = '$idRec'");
    $data = $resultat->fetch();
    $idEleve = $data['idEleve'];
    $idFrais = $data['idFrais'];

    // recherche des informations sur l'eleve et le frais paye
    $resultat1 = $db->selectalldata2("select *, sum(montant_percu) as solde from perception 
                    inner join frais on idFrais = frais.id and idFrais = '$idFrais'
                    inner join eleves on eleves.id=idEleve  and idEleve = '$idEleve'");
    $data1 = $resultat1->fetch();
    ?>
 <!DOCTYPE html>
 <html lang="fr">

 <head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <title>Recu</title>

 <body onload="window.print();">

     <style>
         @media print {
             @page {
                 margin: 0 auto;
                 /* imprtant to logo margin */
                 sheet-size: 400px 250mm;
                 /* imprtant to set paper size */
             }

             html {
                 direction: ltr;

             }

             html,
             body {
                 margin: 0;
                 padding: 0
             }

             #printContainer {

                 width: 250px;
                 margin: auto;
                 background-image: url("juwa.jpg");
                 background-repeat: no-repeat, repeat;
                 background-size: auto;
                 padding: 10px;
                 border: 2px dotted #000;
                 text-align: justify;
             }

             #logo {
                 color: black;
                 font-size: 20px;
                 font-weight: bold;

             }

             .text-center {
                 text-align: center;
             }
         }
     </style>
     </head>

     <body onload="window.print();">
         <div id='printContainer'>
             <h3 id="logo" class="text-center">INSTITUT NYALUKEMBA</h3>
             <h5 id="slogan" style="margin-top:0" class="text-center">Réçu n° <?php echo $idRec ?></h5>
             <table>
                 <tr>
                     <td>Noms : </td>
                     <td><?php echo $data['nom'] . " " . $data['postnom'] . " " . $data['prenom'] ?></td>
                 </tr>
                 <tr>
                     <td>Classe : </td>
                     <td><?php echo $data['classe'] ?></td>
                 </tr>
             </table>

             <table>
                 <tr>
                     <td colspan="2">
                         <hr>
                     </td>
                 </tr>
                 <tr>
                     <td>Montant payé : </td>
                     <td><b><?php echo $data['montant_percu'] . " " . $data['devise'] ?> </b></td>
                 </tr>
                 <tr>
                     <td>Frais payé : </td>
                     <td><?php echo $data['libelle'] ?></td>
                 </tr>
                 <tr>
                     <td colspan="2">
                         <hr>
                     </td>
                 </tr>

                 </tr>

             </table>

             <?php
                $tr1 = $data1['solde'] - ($data1['solde'] - $data['tranche1']);
                $tr2 = ($data1['solde'] - $tr1) - (($data1['solde'] - $tr1) - $data['tranche2']);
                $tr3 = $data1['solde'] - $tr1 - $tr2;
                ?>
             <ol>
                 <li>Premiere tranche : <?php echo $tr1 . " " . $data['devise'] ?></li>
                 <li>Deuxieme tranche : <?php echo $tr2 . " " . $data['devise'] ?> </li>
                 <li>Troisieme tranche : <?php echo $tr3 . " " . $data['devise'] ?></li>
             </ol>
             <?php setlocale(LC_TIME, 'fra_fra'); ?>
             <p>Percepteur(trice): Caissier </p>
             <p>Date: <?php
                        $dat = date_create($data['date_perception']);
                        echo date_format($dat, "d/m/Y");
                        ?>
             </p>
             <?php
                $path = "./images/";
                $file = $path . uniqid() . ".png";
                $text = "Montant:" . $data['montant_percu'] . "" . $data['devise'] . "\n" . "Noms:" . $data['nom'] . " " . $data['postnom'] . "\n" . $data['date_perception'];
                QRcode::png($text, $file, 'L', 4);
                echo "<center><img src='" . $file . "'</center>"
                ?>
         </div>
         <a href="../registre.php">Retour </a>
     </body>

 </html>
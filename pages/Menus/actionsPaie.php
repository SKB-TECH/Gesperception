<?php

    error_reporting( E_ALL );
    ini_set( 'display_errors', 1);

    require_once "../../Classes/crud.php";
    $db=new Crud();

    if(isset($_POST['action']) && $_POST['action']=="view"){
        $output="";
        $resultat=$db->SelectDataWhere('enseignants','paie');
        if($res=$db->total1('enseignants')){
            $output .='
            <table class="table table-striped table-sm table-bordered">
            <thead>
                <th>N°</th>
                <th>Noms</th>
                <th>Montant</th>
                <th>Mituelle</th>
                <th>Avance</th>
                <th>NetApayer</th>
                <th>Mois</th>
                <th>Date</th>
                <th>Actions</th>
            </thead>
            <tbody>';

            while ($data=$resultat->fetch()) {
                $output .='
                <tr class="text-center text-secondary">
                <td>'.$data['id'].'</td>
                <td>'.$data['noms'].'</td>
                <td>'.$data['montant'].'</td>
                <td>'.$data['mituelle'].'</td>
                <td>'.$data['avance'].'</td>
                <td>'.$data['net'].'</td>
                <td>'.$data['mois'].'</td>
                <td>'.$data['dates'].'</td>
                <td>
                    <a href="#" class="text-success infoBtn" title="Info"  id="'.$data['id'].'">
                        <i class="fa fa-info-circle fa-lg "></i>
                    </a>

                    <a href="#" class="text-danger deleteBtn" title="Supprimer" id="'.$data['id'].'">
                        <i class="fa fa-trash fa-lg"></i>
                    </a>
                </td>
                </tr>'
                ;
            }

            $output .="</tbody></table>";
            echo ($output);
        }

        else {
            echo "
            <h3 class='text-center text-secondary mt-5'>
                Pas d'informations sur cette recherche !!!
            </h3>";
        }
    }
    
    /** Fonction recaherche les avances sur salaires */
    if (isset($_POST['idagent'])) {
        $mois=$_POST['mois'];
        $id=$_POST['idagent'];


        $sql="SELECT * FROM `avance` WHERE idagent='$id' AND mois='$mois'";
        $res=$db->SearchAvance($sql);
        $resultat=$res->fetch();
            echo json_encode($resultat);
    }

    //Addition des sommes des depenses +avances sur salaire 


    /** Fonction insert dans la bdd */
    if(isset($_POST['action']) && $_POST['action']=="insert"){
        $idagent=$_POST['idagent'];
        $mois=$_POST['mois'];
        $montant=intval($_POST['montant']);
        $mituelle=intval($_POST['mituelle']);
        $avance=intval($_POST['avance']);
        $net=intval($_POST['net']);
        $dates=$_POST['dates'];

        $sql="INSERT INTO paie (`idagent`,`montant`,`mituelle`,`avance`,`net`,`mois`,`dates`) VALUES ('$id', '$montant', '$mituelle', '$avance', '$net', '$mois', '$dates')";
        $db->insert2($sql);
    }

    /** Fonction modification de la table  enseignants*/
    if(isset($_POST['edit_id'])){
        $id=$_POST['edit_id'];
        $res=$db->selectalldata('paie');
        $row=$res->fetch();
        echo json_encode($row);
    }

    if (isset($_POST['action'])&& $_POST['action']=="update") {
            $idagent=$_POST['idagent'];
            $mois=$_POST['mois'];
            $montant=intval($_POST['montant']);
            $mituelle=intval($_POST['mituelle']);
            $avance=intval($_POST['avance']);
            $net=intval($_POST['net']);
            $dates=$_POST['dates'];
        
        $db->Modification($id,$noms,$sexe,$grade,$domaine,$adresse,$telephone);
        echo ($data);
    }

    /** Fonction Suprimmer de la table  enseignants*/
    if(isset($_POST['del_id'])){
        $id=$_POST['del_id'];
        $row=$db->deletedata('paie','id',$id);
       
    }

    /** Fonction info plus de la table  enseignants*/
    if(isset($_POST['info_id'])){
        $id=$_POST['info_id'];
        $row=$db->selectbyid($id,'paie');
    
        echo json_encode($row);
    }

    /** exportation de la liste Excel */
    if (isset($_GET['export']) && $_GET['export']=="excel") {
        header('Content-type:application/xls');
        header('Content-Disposition:attachement;filename=Enseignants.xls');
        header('Pragma:no-cache');
        header('Expire:0');

        $resultat=$db->SelectDataWhere('enseignants','paie');;
        echo '<table border="1">';
        echo '<tr><th>Num</th><th>Noms</th><th>Montant</th><th>Mituelle</th><th>Avance</th><th>Net A Payer</th><th>Mois</th><th>Date</th></tr>';

        while ($data=$resultat->fetch()) {
            echo '<tr>
            <tr class="text-center text-secondary">
            <td>'.$data['id'].'</td>
            <td>'.$data['noms'].'</td>
            <td>'.$data['montant'].'</td>
            <td>'.$data['mituelle'].'</td>
            <td>'.$data['avance'].'</td>
            <td>'.$data['net'].'</td>
            <td>'.$data['mois'].'</td>
            <td>'.$data['dates'].'</td>
        </tr>';
    
        }
        echo '</table>';
    }
    ?>
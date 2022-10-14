<?php
    error_reporting( E_ALL );
    ini_set( 'display_errors', 1);

    require_once "../../Classes/crud.php";
    $db=new Crud();

    if(isset($_POST['action']) && $_POST['action']=="view"){
        $output="";
        $resultat=$db->SelectDataWhere('enseignants','avance');
        if($res=$db->total1('avance')){
            $output .='
            <table class="table table-striped table-sm table-bordered">
            <thead>
                <th>N°</th>
                <th>Noms</th>
                <th>Mois</th>
                <th>Montant</th>
                <th>Um</th>
                <th>Date</th>
                <th>Actions</th>
            </thead>
            <tbody>';

            while ($data=$resultat->fetch()) {
                $output .='
                <tr class="text-center text-secondary">
                <td>'.$data['id'].'</td>
                <td>'.$data['noms'].'</td>
                <td>'.$data['mois'].'</td>
                <td>'.$data['montant'].'</td>
                <td>'.$data['um'].'</td>
                <td>'.$data['dates'].'</td>
                <td>
                    <a href="#" class="text-success infoBtn" title="Info"  id="'.$data['id'].'">
                        <i class="fa fa-info-circle fa-lg "></i>
                    </a>

                    <a href="#" class="text-primary editBtn" title="Modifier" data-toggle="modal" data-target="#editModal" id="'.$data['id'].'">
                        <i class="fa fa-edit fa-lg"></i>
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
    
    /** Fonction insert dans la bdd */
    if(isset($_POST['action']) && $_POST['action']=="insert"){
        $id=$_POST['agent'];
        $mois=$_POST['mois'];
        $montant=$_POST['montant'];
        $um=$_POST['um'];
        $dates=$_POST['dates'];
        $sql=("INSERT INTO avance(idagent,mois,montant,um,dates)VALUES('$id','$mois','$montant','$um','$dates')");
        
        $db->insert2($sql);
        echo("ok");
    }

    /** Fonction modification de la table  enseignants*/
    if(isset($_POST['edit_id'])){
        $id=$_POST['edit_id'];
        $row=$db->selectbyid($id,'avance');
        echo json_encode($row);
    }
    if (isset($_POST['action'])&& $_POST['action']=="update") {
            
            $id=$_POST['id'];
            $agent=$_POST['agent'];
            $mois=$_POST['mois'];
            $montant=$_POST['montant'];
            $dates=$_POST['dates'];
            $um=$_POST['um'];
            $db->ModificationAvance($id,$agent,$mois,$montant,$um,$dates);
        // echo ($data);
    }

    /** Fonction Suprimmer de la table  enseignants*/
    if(isset($_POST['del_id'])){
        $id=$_POST['del_id'];
        $row=$db->deletedata('avance','idagent',$id);
       
    }

    /** Fonction info plus de la table  enseignants*/
    if(isset($_POST['info_id'])){
        $id=$_POST['info_id'];

        $row=$db->selectbyid($id,'avance');
        echo json_encode($row);
    }

    /** exportation de la liste Excel */
    if (isset($_GET['export']) && $_GET['export']=="excel") {
        header('Content-type:application/xls');
        header('Content-Disposition:attachement;filename=Enseignants.xls');
        header('Pragma:no-cache');
        header('Expire:0');

        $resultat=$db->SelectDataWhere('enseignants','avance');
        echo '<table border="1">';
        echo '<tr><th>N°</th><th>Noms</th><th>Mois</th><th>Montant</th><th>Um</th><th>Date</th></tr>';
        $i=1;
        while ($data=$resultat->fetch()) {
           
            echo '<tr>
            <tr class="text-center text-secondary">
            <td>'.$i.'</td>
            <td>'.$data['noms'].'</td>
            <td>'.$data['mois'].'</td>
            <td>'.$data['montant'].'</td>
            <td>'.$data['um'].'</td>
            <td>'.$data['dates'].'</td>
        </tr>';
            $i++;
        }
        echo '</table>';
    }
?>
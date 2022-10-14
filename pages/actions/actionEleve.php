<?php
    error_reporting( E_ALL );
    ini_set( 'display_errors', 1);

    require_once "../../Classes/crud.php";
    $db=new Crud();

    if(isset($_POST['action']) && $_POST['action']=="view"){
        $output="";
        $resultat=$db->selectalldata('eleves');
        if($res=$db->selectalldata('eleves')){
            $output .='
            <table class="table table-striped table-sm table-bordered">
            <thead>
                <th>N°</th>
                <th>Noms</th>
                <th>Classe</th>
                <th>Actions</th>
            </thead>
            <tbody>';

            while ($data=$resultat->fetch()) {
                $output .='
                <tr class="text-center text-secondary">
                    <td>'.$data['id'].'</td>
                    <td>'.$data['nom']." ".$data['postnom']." ".$data['prenom'].'</td>
                    <td>'.$data['classe'].'</td>
                    
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
                Aucune donnee disponible !!!
            </h3>";
        }
    }
    
    /** Fonction insert dans la bdd */
    if(isset($_POST['action']) && $_POST['action']=="insert"){
        $nom=$_POST['nom'];
        $postnom=$_POST['postnom'];
        $prenom=$_POST['prenom'];
        $sexe=$_POST['sexe'];
        $date_naissance=$_POST['date_naissance'];
        $lieu_naissance=$_POST['lieu_naissance'];
        $classe=$_POST['classe'];
        $sql=("INSERT INTO eleves(nom,postnom,prenom,sexe,date_naissance,lieu_naissance,classe)VALUES('$nom','$postnom','$prenom','$sexe','$date_naissance','$lieu_naissance','$classe')");
        $db->insert2($sql);
    }

    /** Fonction modification de la table  enseignants*/
    if(isset($_POST['edit_id'])){
        $id=$_POST['edit_id'];
        $row=$db->selectbyid($id,'eleves');
        // print_r($row); 
        echo json_encode($row);
    }
    if (isset($_POST['action'])&& $_POST['action']=="update") {
            
            $id=$_POST['id'];
            $nom=$_POST['nom'];
            $postnom=$_POST['postnom'];
            $prenom=$_POST['prenom'];
            $sexe=$_POST['sexe'];
            $date_naissance=$_POST['date_naissance'];
            $lieu_naissance=$_POST['lieu_naissance'];
            $classe=$_POST['classe'];
        
        $sql = "UPDATE  eleves SET nom='$nom',postnom='$postnom',prenom='$prenom',sexe='$sexe',date_naissance='$date_naissance',lieu_naissance='$lieu_naissance',classe='$classe' where id='$id'";
        $data= $db->update2($sql);
        print_r($data);
    }

    /** Fonction Suprimmer de la table  enseignants*/
    if(isset($_POST['del_id'])){
        $id=$_POST['del_id'];
        
        $row=$db->deletedata('eleves','id',$id);
       
    }

    /** Fonction info plus de la table  enseignants*/
    if(isset($_POST['info_id'])){
        $id=$_POST['info_id'];

        $row=$db->selectbyid($id,'eleves');
    
        echo json_encode($row);
    }

    /** exportation de la liste Excel */
    if (isset($_GET['export']) && $_GET['export']=="excel") {
        header('Content-type:application/xls');
        header('Content-Disposition:attachement;filename=Enseignants.xls');
        header('Pragma:no-cache');
        header('Expire:0');

        $resultat=$db->selectalldata('eleves');
        echo '<table border="1">';
        echo '<tr><th>N°</th><th>Nom</th><th>Postom</th><th>Prenom</th>
                <th>Sexe</th><th>Classe</th><th>Lieu</th><th>Naissance</th></tr>';

        while ($data=$resultat->fetch()) {
            echo '<tr>
            <tr class="text-center text-secondary">
            <td>'.$data['id'].'</td>
            <td>'.$data['nom'].'</td>
            <td>'.$data['postnom'].'</td>
            <td>'.$data['prenom'].'</td>
            <td>'.$data['sexe'].'</td>
            <td>'.$data['classe'].'</td>
            <td>'.$data['lieu_naissance'].'</td>
            <td>'.$data['date_naissance'].'</td>
        </tr>';
    
        }
        echo '</table>';
    }
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../../Classes/crud.php";
$db = new Crud();

if (isset($_POST['action']) && $_POST['action'] == "view") {
    $output = "";
    $sql = "SELECT *, perception.id as code FROM `perception` inner JOIN frais on frais.id=idFrais inner join eleves on eleves.id=idEleve";

    if ($res = $db->selectalldata2($sql)) {
        $output .= '
            <table class="table table-striped table-sm table-bordered">
            <thead>
                <th>N°</th>
                <th>Noms</th>
                <th>Classe</th>
                <th>Montant</th>
                <th>Date</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>';
        while ($data = $res->fetch()) {
            $output .= '
                <tr class="text-center text-secondary">
                    <td>' . $data['code'] . '</td>
                    <td>' . $data['nom'] . " " . $data['postnom'] . " " . $data['prenom'] . '</td>
                    <td>' . $data['classe'] . '</td>
                    <td>' . $data['montant_percu'] . ' ' . $data['devise'] . '</td>
                    <td>' . $data['date_perception'] . '</td>
                    
                    <td>
                        <a href="#" class="text-primary editBtn" title="Modifier" data-toggle="modal" data-target="#editModal" id="' . $data['code'] . '">
                            <i class="fa fa-edit fa-lg"></i>
                        </a>

                    </td>
                    <td>
                     <a href="impressions/recu.php?idRec=' . $data['code'] . '" class="text-secondary " >
                        <i class="fa fa-print fa-lg"></i>
                    </a>
                </td>
                </tr>';
        }
        $output .= "</tbody></table>";
        echo ($output);
    } else {
        echo "
            <h3 class='text-center text-secondary mt-5'>
                Aucune donnee disponible !!!
            </h3>";
    }
}

/** Fonction modification de la table  perception*/
if (isset($_POST['edit_id'])) {
    $id = $_POST['edit_id'];
    $res = $db->selectalldata2("SELECT *, perception.id as idPerc FROM `perception` inner JOIN frais on frais.id=idFrais inner join eleves on eleves.id=idEleve WHERE perception.id='$id'");
    $row = $res->fetch();
    echo json_encode($row);
}
if (isset($_POST['action']) && $_POST['action'] == "update") {
    $id = $_POST['id'];
    $montant_percu = $_POST['montant_percu'];
    $date_perception = $_POST['date_perception'];

    $sql = "UPDATE perception SET montant_percu='$montant_percu', date_perception='$date_perception' where id='$id'";
    $data = $db->update2($sql);
    print_r($data);
}

/** Fonction Suprimmer de la table  */
if (isset($_POST['del_id'])) {
    $id = $_POST['del_id'];

    $row = $db->deletedata('perception', 'id', $id);
}

/** Fonction info plus de la table  */
if (isset($_POST['info_id'])) {
    $id = $_POST['info_id'];

    $row = $db->selectbyid($id, 'perception');

    echo json_encode($row);
}

/** exportation de la liste Excel */
if (isset($_GET['export']) && $_GET['export'] == "excel") {
    header('Content-type:application/xls');
    header('Content-Disposition:attachement;filename=Enseignants.xls');
    header('Pragma:no-cache');
    header('Expire:0');

    $resultat = $db->selectalldata('perception');
    echo '<table border="1">';
    echo '<tr><th>N°</th><th>Nom</th><th>Postom</th><th>Prenom</th>
                <th>Sexe</th><th>Classe</th><th>Lieu</th><th>Naissance</th></tr>';

    $resultat = $db->selectalldata2("select *, sum(montant_percu) as solde from perception 
                inner join frais on idFrais = frais.id inner join eleves on eleves.id = idEleve");

    while ($data = $resultat->fetch()) {
        echo '<tr>
            <tr class="text-center text-secondary">
            <td>' . $data['id'] . '</td>
            <td>' . $data['nom'] . " " . $data['postnom'] . " " . $data['prenom'] . '</td>
            <td>' . $data['classe'] . '</td>
            <td>' . $data['montant_percu'] . '</td>
            <td>' . $data['date_perception'] . '</td>
        </tr>';
    }
    echo '</table>';
}

// affiche resultat solde 
if (isset($_POST['action']) && $_POST['action'] == "solde") {
    $id = $_POST['idFrais'];
    $idEleve = $_POST['idEleve'];
    $output = "";

    $resultat = $db->selectalldata2("select *, sum(montant_percu) as solde from perception 
            inner join frais on idFrais = frais.id and idFrais = '$id' and idEleve='$idEleve'");
    $data = $resultat->fetch();
    if ($data) {
        $output .= '
                <p class="text-center text-secondary">
                        <b>' . "Solde : " . $data['solde'] . " " . $data['devise'] . "
                         / " . $data['montant_frais'] . " " . $data['devise'] . '</b> 
                         <input type="hidden" id="solde_value" name="solde" value=' . $data['solde'] . '>
                         <input type="hidden" id="" name="frais" value=' . $data['montant_frais'] . '>
                </p>';
    } else {
        $output .= "
                <p class='text-center text-secondary mt-5'>
                     Le solde est 0 pour le frais selectionné
                </p>";
    }
    echo ($output);
}

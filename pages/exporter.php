<?php
    include "connexion.php";
    $dt = '';
    if(isset($_POST["test"])){
    $sql = "SELECT * FROM etudiants";
    if($res = $pdo->query($sql)){
            $dt .= '
                <table class="table" bordered="1">
                    <tr>
                        <th>N°M</th>
                        <th>Nom</th>
                        <th>Postnom</th>
                        <th>Prenom</th>
                        <th>Sexe</th>
                        <th>Telephone</th>
                        <th>mail</th>
                        <th>Action</th>
                    </tr>';
            
		while($data= $res->fetch()){
            $dt .= '
                <tr>
                    <td>'.$data["idEtudiant"].'</td>
                    <td>'.$data["nom"].'</td>
                    <td>'.$data["postnom"].'</td>
                    <td>'.$data["prenom"].'</td>
                    <td>'.$data["sexe"].'</td>
                    <td>'.$data["numero"].'</td>
                    <td>'.$data["mail"].'</td>
                </tr>';
        }
        $dt.='</table>';
        header("Content-Type: application/xls");
        header("Content-Disposition:attachment; filename=download.xls");
        echo $dt;
    }
}

?>
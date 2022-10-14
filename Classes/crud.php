<?php

include_once('Connexion/Database.php');

class Crud extends Database
{
        public $columns = "";
        public $values = "";
        public $column = "";
        public $value = "";

        public function __construct()
        {
                parent::__construct();
        }
        //afficher  toutes les donnees de la bdd
        public function selectalldata($table)
        {
                $select = "SELECT * FROM $table";
                $select1 = $this->connection->query($select);
                return $select1;
        }

        public function selectalldata2($sql)
        {
                $select1 = $this->connection->query($sql);
                return $select1;
        }
        // affichier les donnees de la table par id
        public function selectbyid($id, $tab)
        {
                $sel = "SELECT * FROM $tab WHERE id=$id";
                $res = $this->connection->query($sel);
                return $res->fetch();
        }

        public function selectbyid2($idagent, $tab, $tab1)
        {
                $sel = "SELECT * FROM $tab WHERE idagent=$idagent";
                $res = $this->connection->query($sel);
                return $res->fetch();
        }

        public function update($data, $table, $labelId, $id)
        {
                foreach ($data as $this->column => $this->value) {
                        $update = ("UPDATE $table SET $this->column = '$this->value' WHERE $labelId= '$id'");
                        $this->connection->query($update);
                }
                return true;
        }
        public function update2($sql)
        {
                $this->connection->query($sql);
                return true;
        }
        // suppression d'une donnees dans la table 
        function deletedata($table, $labelId, $where)
        {
                $delete = ("DELETE FROM $table WHERE $labelId=$where");
                $this->connection->query($delete);
                return true;
        }
        public function insert2($sql)
        {
                if ($sql != "") {
                        $insert1 = $this->connection->query($sql);
                        return $this->connection->lastInsertId();
                } else {
                        return null;
                }
        }
        public function escape_string($value)
        {
                return $this->connection->quote($value);
        }

        public function Total($tab,$champ,$lab)
        {
                $sql = ("SELECT * FROM $tab where $champ='$lab'");
                $stms = $this->connection->prepare($sql);
                $stms->execute();
                return $tot = $stms->rowCount();
        }

        public function total1($tab)
        {
                $sql = ("SELECT * FROM $tab");
                $stms = $this->connection->prepare($sql);
                $stms->execute();
                return $tot = $stms->rowCount();
        }

        public function Modification($id, $nm, $se, $gr, $do, $ad, $te)
        {
                $sql = "UPDATE enseignants SET noms=:nm,sexe=:se,grade=:gr,domaine=:do,adresse=:ad,telephone=:te WHERE id=:id";
                $stms = $this->connection->prepare($sql);
                $stms->execute((['nm' => $nm, 'se' => $se, 'gr' => $gr, 'do' => $do, 'ad' => $ad, 'te' => $te, 'id' => $id]));
                return true;
        }

        public function SelectDataWhere($table1, $table2)
        {
                $select = "SELECT * FROM $table1 inner join $table2 ON $table1.id=$table2.idagent";
                $data = $this->connection->query($select);
                return $data;
        }

        public function SelectDataWherePaie($table1, $table2, $id)
        {
                $select = "SELECT * FROM $table1 inner join $table2 ON $table1.idagent=$table2.idagent WHERE $table1.id=$id";
                $data = $this->connection->query($select);
                return $data;
        }

        public function SearchAvance($sql)
        {
                //$sql="SELECT montant FROM avance WHERE idagent=$idagent AND mois=$mois";
                $data = $this->connection->query($sql);
                return $data;
        }

        public function ModDepenses($id, $motif, $montant, $um, $mois, $dates)
        {
                $sql = "UPDATE depense SET motif=:mot,montant=:mont,um=:um,mois=:mois,dates=:dates WHERE id=:id";
                $stms = $this->connection->prepare($sql);
                $stms->execute(([
                        'mot' => $motif, 'mont' => $montant, 'um' => $um, 'mois' => $mois, 'dates' => $dates, 'id' => $id
                ]));

                return true;
        }

        public function ModificationAvance($id, $agent, $mois, $montant, $um, $dates)
        {
                $sql = "UPDATE avance SET idagent=:agent,mois=:mois,montant=:montant,um=:um,dates=:dates WHERE id=:id";
                $stms = $this->connection->prepare($sql);
                $stms->execute(([
                        'agent' => $agent, 'mois' => $mois, 'montant' => $montant, 'um' => $um, 'dates' => $dates, 'id' => $id
                ]));

                return true;
        }
        public function Compte($champ, $table)
        {
                $sql = "SELECT SUM($champ) as somme FROM $table";
                $somme = $this->connection->query($sql);
                return $somme;
        }

        public function Authentification($log,$pwd){ 
                $sql="SELECT * FROM User WHERE logine='$log' AND password='$pwd'";
                $stms = $this->connection->prepare($sql);
                $stms->execute();
                return $total= $stms->rowCount();
        }

        public function insert($sql)
        {
                if ($sql != "") {
                        $stmt=$this->connection->prepare($sql);
                        $stmt->execute();
                }
        }


}
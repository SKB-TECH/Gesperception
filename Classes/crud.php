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
        // affichier les donnees de la table par id
        public function selectbyid($table, $labelId, $id)
        {
                $sel = "SELECT * FROM $table where $labelId=$id";
                $sel1 = $this->connection->query($sel);
                return $sel1->fetch();
        }

        public function insert($data, $table)
        {
                foreach ($data as $this->column => $this->value) {

                        $this->columns .= ($this->columns == "") ? "" : ", ";
                        $this->columns .= $this->column;

                        $this->values .= ($this->values == "") ? "" : ", ";
                        $this->values .= "'" . $this->value . "'";
                }

                $insert = ("INSERT into $table ($this->columns) values ($this->values)");
                $insert1 = $this->connection->query($insert);
        }

        public function update($data, $table, $labelId, $id)
        {
                foreach ($data as $this->column => $this->value) {
                        $update = ("UPDATE $table SET $this->column = '$this->value' WHERE $labelId= '$id'");
                        $this->connection->query($update);
                }
                return true;
        }
        // suppression d'une donnees dans la table 
        function deletedata($table, $labelId, $where)
        {
                $delete = ("DELETE FROM $table WHERE $labelId=$where");
                $this->connection->query($delete);
                return true;
        }

        public function escape_string($value)
        {
                return $this->connection->quote($value);
        }

        }
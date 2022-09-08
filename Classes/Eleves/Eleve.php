<?php

require_once "./Classes/Connexion/Database.php";

class Eleve
    {
        /**
         * Cette fonction sert a insere les information des eleves dans la bdd
         */
        public function insert($nom,$postnom,$prenom,$sexe,$dates,$lieu,$idclasse)
        {
            $sql="INSERT INTO eleves(nom,postnom,prenom,sexe,date_naissance,lieu_naissance,idclasse)
            VALUES(:nm,:pos,:pre,:se,:dte,:lie,:id)";
            
            $stmt=$conn->prepare($sql);
            $stmt->execute(['nm'=>$nom,'pos'=>$postnom,'pre'=>$prenom,'se'=>$sexe,'dte'=>$dates,'lie'=>$lieu,'id'=>$idclasse]);

            return true;
        }

        /**
         * cette fonction permet d'affiche tout les eleves
         */
        public function findAll(){
            $data=array();
            $sql="SELECT *FROM eleves";
            $stmt=$conn->prepare($sql);
            $stmt=execute();
            $res=$stmt->fecthAll(PDO::FETCH_ASSOC);
            foreach ($res as $rows) {
                $data[]=$rows;
            }
            
            return $data;
        }

        /**
         * Affiche un eleve par identifiant
         */
        public function findBy($id){
            $sql="SELECT FROM eleves WHERE code_eleve=:id";
            $stmt=$conn->prepare($sql)
            $stmt->execute(['id'=>$id]);
            $res=$stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        }

        public function delete($nom){
            $sql="DELETE  FROM eleves WHERE nom=:nom";
            $stmt=$conn->prepare($sql)
            $stmt->execute(['nom'=>$id]);

            return true;
        }

        public function total(){
            $sql="DELETE  * FROM eleves ";
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            $t_rowa=$stmt->rowsCount();

            return $t_rowa;
        }
    }
?>
<?php 
/**
 * cette classe permet de se connecte a la base des donnees
 */
    
    class Database
    {
        private $_localhost = 'localhost'; 
        private $_user = 'root'; 
        private $_password = ''; 
        private $_dbname = 'nyalukemba_db'; 
         
        protected $connection; 
         
         public function __construct() 
         { 
         
         if(!isset($this-> connection)) 
         { 
                $this->connection = new PDO("mysql:host=".$this->_localhost.";dbname=".$this->_dbname."", $this->_user , $this->_password); 
         
         } 
         
         return $this->connection; 
         
         } 
    }

    // $bdd=new Database()
?>
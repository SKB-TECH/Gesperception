<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
    require_once ("../../Classes/crud.php");
    $tache=new crud();

    if(isset($_POST["logine"])){
        $logine=trim($_POST['logine']);
        $password=trim($_POST['password']);
        $res=$tache->Authentification($logine,$password);
        if ($res>0) {
            header("Location:../Enseignants.php");
        }

        else
        {
            header('Location:index.php');
        }

        
    }
?>
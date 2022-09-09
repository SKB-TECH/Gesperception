<?php
         error_reporting( E_ALL );
         ini_set( 'display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Styles/style.css">
    <link rel="stylesheet" href="../../Styles/styleII.css">
    <link rel="stylesheet" href="../../font/font-awesome-4.7.0/css/font-awesome.min.css">
    <title>menu</title>
    

</head>

<body>

    <?php include ("../static/header.php")?>
    <main id="main">
             <?php include("../static/sidebar.php") ?>
        <section id="principal">
             <?php include("../static/topcard.php") ?>
            <div class="tableau">
                <div>
                    <div class="container-form">
                    <form action="" class="form" >
                        <input type="text" class="text" id="search" autocomplete="off">
                        <input type="date" name="" id="date">
                        <select name="" id="" class="combobox">
                            <option value="">Tout</option>
                            <option value="">Noms eleve</option>
                            <option value="">Classe</option>
                            <option value="">Annee-Scolaire</option>
                            <option value="">Date</option>
                        </select>
                            <button class="btne">Exporter F Excel</button>
                            <button class="btni">Importer F Excel</button>
                            <button class="btnim modal-btn modal-trigger">Nouveau</button>
                    </form>
                    </div>
                    <table class="tableau-style">
                        <thead>
                            <tr>
                            <th>Noms</th>
                            <th>Postnom</th>
                            <th>Postnom</th>
                            <th>Postnom</th>
                            <th>Postnom</th>
                            <th>Postnom</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td>Noms</td>
                            <td>Postnom</td>
                            <td>Postnom</td>
                            <td>Postnom</td>
                            <td>Postnom</td>
                            <td>Postnom</td>
                            </tr>
                            <tr>
                            <td>Noms</td>
                            <td>Postnom</td>
                            <td>Postnom</td>
                            <td>Postnom</td>
                            <td>Postnom</td>
                            <td>Postnom</td>
                            </tr>
                            <tr>
                            <td>Noms</td>
                            <td>Postnom</td>
                            <td>Postnom</td>
                            <td>Postnom</td>
                            <td>Postnom</td>
                            <td>Postnom</td>
                            </tr>
                            <tr>
                            <td>Noms</td>
                            <td>Postnom</td>
                            <td>Postnom</td>
                            <td>Postnom</td>
                            <td>Postnom</td>
                            <td>Postnom</td>
                            </tr>
                            <tr>
                            <td>Noms</td>
                            <td>Postnom</td>
                            <td>Postnom</td>
                            <td>Postnom</td>
                            <td>Postnom</td>
                            <td>Postnom</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container_card2">
                <div class="card2"></div>
                <div class="card2"></div>
            </div>
        </section>
    </main>

    <!-- Fenetre modal pour l'enregistrement -->
    <div class="modal-container">
        <div class="overlay modal-trigger">
        </div>
        <div class="modal">
            <span class="close-modal modal-trigger">X</span>
            <h3>NOUVEAU ENSEIGNANT</h3>
            <form action="../../pages/Enseignants.php" method="POST" class="form-control">
                <input type="text" name="noms" id="" class="inputs" placeholder="noms de l'enseignant">
                <input type="text" name="grade" id="" class="inputs" placeholder="grade">
                <select name="sexe" id="" class="inputs" >
                    <option value="" class="inputs">Selectionner le sexe...</option>
                    <option value="Homme" class="inputs">Homme</option>
                    <option value="Femme" class="inputs">Femme</option>
                </select>
            
                <input type="text" name="adresse" id="" class="inputs" placeholder="adresse">
                <input type="text" name="telephone" id="" class="inputs" placeholder="telephone">
                <input type="text" name="domaine" id="" class="inputs">
                <input type="submit" name="" id="" class="inputs" value="ENREGISTRER" placeholder="domaine">
            </form>
        </div>
    </div>
</body>
<script src="../../Classes/Javascript/modal.js"></script>
</html>

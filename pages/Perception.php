<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("../Classes/crud.php");
$taches = new crud();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../node_modules//sweetalert2/dist/sweetalert2.min.css">
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/jquery/dist/jquery.js"></script>
    <link rel="stylesheet" href="../node_modules/datatables.net-dt/css/jquery.dataTables.min.css">
    <script src="../node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../node_modules/popper.js/dist/popper.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="../font/font-awesome-4.7.0/css/font-awesome.min.css">

    <title>Percetion</title>
    <script>
        // affiche les resultat
        function showSolde() {
            let idFrais = $('#idFrais').val()
            let idEleve = $('#id').val()
            $.ajax({
                url: "actions/actionPerception.php",
                type: "POST",
                data: {
                    action: "solde",
                    idFrais: idFrais,
                    idEleve: idEleve,
                },
                success: function(reponse) {
                    console.log(reponse);
                    $("#solde").html(reponse);
                    // $("#solde").html(reponse);
                }
            });
        }
    </script>
    <?php require_once("../pages/Menus/Navbar.php") ?>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- sidebar -->
        <div class="bg-primary" style="z-index: 0;">
            <?php require_once("../pages/Menus/Sidebar.php") ?>
        </div>
        <!-- sidebar end -->
        <div class="container" style="z-index:0;">
            <!-- Debut card -->
            <div class="container-fluid px-4" style="margin-top:70px;">
                <div class="row g-3 my-3">
                    <div class="col-sm-2">
                        <div class="p-3 bg-white  shadow-lg d-flex justify-content-around align-items-center rounded">
                            <div>
                                <?php $res = $taches->Compte("montant_percu", 'perception');
                                $data = $res->fetch();
                                $entre = $data[0];
                                ?>
                                <h6 class="fs-2 font-bold"><?php echo ($entre) ?> &nbsp;$</h6>
                                <p class="fs-5">ENTREES</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="p-3 bg-white  shadow-lg d-flex justify-content-around align-items-center rounded">
                            <div>
                                <?php $res = $taches->Compte("montant", 'depense');
                                $res = $res->fetch();
                                $sortie1 = $res[0];
                                ?>
                                <h6 class="fs-2 font-bold"><?php echo ($sortie1) ?> &nbsp;$</h6>
                                <p class="fs-5">DEPENSES</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="p-3 bg-white  shadow-lg d-flex justify-content-around align-items-center rounded">
                            <div>
                                <?php $res = $taches->Compte("montant", 'avance');
                                $des = $res->fetch();
                                $avance = $des[0]
                                ?>
                                <h6 class="fs-2 font-bold"><?php echo ($avance) ?> &nbsp;$</h6>
                                <p class="fs-5">AVANCES</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="p-3 bg-white  shadow-lg d-flex justify-content-around align-items-center rounded">
                            <div>
                                <?php $res = $taches->Compte("net", 'paie');
                                $sal = $res->fetch();
                                $paie = $sal[0]
                                ?>
                                <h6 class="fs-2 font-bold"><?php echo ($paie) ?> &nbsp;$</h6>
                                <p class="fs-5">SALAIRES</p>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-2">
                        <div class="p-3 bg-white  shadow-lg d-flex justify-content-around align-items-center rounded">
                            <div style="font-weight: 400">
                                <h6 class="fs-2 font-bold"><?php echo ($entre - $sortie1 - $avance - $paie); ?> &nbsp;$</h6>
                                <p class="fs-5">SOLDE</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin card -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="text-center text-danger">Tableau de Bord</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="mt-2 text-primary">Perception des frais scolaire</h5>
                    </div>

                    <div class="clog-lg-6">
                        <a href="registre.php" class="btn btn-success m-1 float-lg"><i class="fa fa-table fa-lg"></i>
                            Voir le registre des paiements
                        </a>
                    </div>
                </div>
                <hr class="my-1">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive" id="showUser">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour enregistrement -->
    <!-- The Modal -->
    <div class="modal fade" id="addModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Perception: Ajout</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" method="POST" id="form-data">
                        <input type="hidden" id="id" name="id">
                        <p id="details_eleve"></p>
                        <div class="form-group">
                            <label for="idFrais">Frais : </label>
                            <select name="idFrais" onchange='showSolde()' id="idFrais" class="form-control" required>
                                <option value=""></option>
                                <?php
                                $resFrais = $taches->selectalldata("frais");
                                while ($data = $resFrais->fetch()) {                                ?>
                                    <option value="<?php echo $data['id'] ?>"><?php echo $data['libelle'] ?></option>
                                <?php } ?>
                            </select>
                            <div id="solde">

                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="form-group col-7">
                                <label for="montant">Montant pércu : </label>
                                <input type="currency" min="0" name="montant_percu" class="form-control " placeholder="Montant percu" required>
                            </div>
                            <div class="form-group col-5">
                                <label for="date">Date : </label>
                                <input type="date" name="date_perception" class="form-control " placeholder="date_perception" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="insert" id="insert" class="btn btn-primary btn-block" value="ENREGISTRER">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Les lebrairies Javascript -->
    <script>
        // 
        /** fonction pour Afficher les donnes avec ajax  */
        $(document).ready(() => {
            // $("#idFrais").change(showSolde());
            showAllUser()

            function showAllUser() {
                $.ajax({
                    url: "actions/actionPerception.php",
                    type: "POST",
                    data: {
                        action: "view"
                    },
                    success: function(reponse) {
                        // console.log(reponse);
                        $("#showUser").html(reponse);
                        $("table").DataTable({
                            order: [0, 'desc']
                        });
                    }
                });
            }

            /** Fonction insert dans la bdd */
            $("#insert").click(function(e) {
                if ($("#form-data")[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                        url: "actions/actionPerception.php",
                        type: "POST",
                        data: $("#form-data").serialize() + "&action=insert",
                        success: function(reponse) {

                            window.location.href = `./impressions/recu.php?idRec=${reponse}`,

                                Swal.fire(
                                    'Felicitation', // 'Felicitation!',
                                    "Payement enregistré",
                                    'success'
                                )
                            $("#addModal").modal('hide');
                            $("#form-data")[0].reset();
                            showAllUser();
                        }
                    });
                }
            })

            /** La fonction pour la modification  */
            $("body").on("click", ".editBtn", function(e) {
                e.preventDefault();
                edit_id = $(this).attr('id');

                $.ajax({
                    url: "actions/actionPerception.php",
                    type: "POST",
                    data: {
                        edit_id: edit_id
                    },
                    success: function(reponse) {
                        data = JSON.parse(reponse);
                        $("#id").val(data.id);
                        $("#details_eleve").text("Elève : " + data.nom + " " + data.postnom + " " + data.prenom + "       Classe: " + data.classe);
                    }
                })
            });

            /** Info plus */
            $("body").on("click", '.infoBtn', function(e) {
                e.preventDefault();
                info_id = $(this).attr('id');
                $.ajax({
                    url: "./actions/actionPerception.php",
                    type: "POST",
                    data: {
                        info_id: info_id
                    },
                    success: function(reponse) {
                        data = JSON.parse(reponse);

                        if (data.length > 0) {
                            let html = '' + data[0].nom + ' ' + data[0].postnom + ' ' + data[0].prenom + ' ' + data[0].classe + '<br>' + data.map((res) => {
                                let tr1 = res.somme - (res.somme - res.tranche1);
                                let tr2 = (res.somme - tr1) - ((res.somme - tr1) - res.tranche2);
                                let tr3 = res.somme - tr1 - tr2;
                                return (
                                    '<b class="text-left">' + res.libelle + ' : ' +
                                    res.somme + ' ' + res.devise + ' en ' + res.mouvement + ' versement(s)' +
                                    '</b></hr><ol>' +
                                    '<li>Premiere tranche : ' + tr1 + ' </li>' +
                                    '<li>Deuxieme tranche : ' + tr2 + '</li>' +
                                    '<li>Troisieme tranche : ' + tr3 + ' </li>' +
                                    '</ol>'
                                )
                            })
                        }
                        showAllUser();
                    }
                })


            });
        });
    </script>
</body>

</html>
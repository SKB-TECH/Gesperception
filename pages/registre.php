<?php
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

    <title>Registre des Paie</title>
    <?php require_once("../pages/Menus/Navbar.php") ?>
    <script>
        // affiche les resultat
        function showSolde() {
            let idFrais = $('#idFrais').val()
            let idEleve = $('#id').val()
            $.ajax({
                url: "actions/actionRegistre.php",
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
                        <h5 class="mt-2 text-primary">Registre des paiements</h5>
                    </div>

                    <div class="clog-lg-6">
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
    <!-- Modification Modal -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Modification Enseignant</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" method="POST" id="edit-form-data">
                        <input type="hidden" id="id" name="id" required>
                        <p id="details_eleve"></p>
                        <div class="form-group">
                            <label for="idFrais">Frais : </label>
                            <select name="idFrais" onchange='showSolde()' id="idFrais" class="form-control" required>
                                <option value="">Clique ici pour modifier le frais</option>
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
                                <input type="currency" min="0" id="montant" name="montant_percu" class="form-control " placeholder="Montant percu" required>
                            </div>
                            <div class="form-group col-5">
                                <label for="date">Date : </label>
                                <input type="date" id="date" name="date_perception" class="form-control " placeholder="date_perception" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="update" id="update" class="btn btn-danger btn-block" value="MODIFIER">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de la fenetre modal Modification-->

    <!-- Fin de la fenetre modal -->
    <!-- Les lebrairies Javascript -->
    <script>
        /** fonction pour Afficher les donnes avec ajax  */
        $(document).ready(() => {
            showAllUser()

            function showAllUser() {
                $.ajax({
                    url: "actions/actionRegistre.php",
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
                        url: "actions/actionRegistre.php",
                        type: "POST",
                        data: $("#form-data").serialize() + "&action=insert",
                        success: function(reponse) {
                            Swal.fire(
                                'Felicitation!',
                                'Elève Ajouté(e) avec success !',
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
                    url: "actions/actionRegistre.php",
                    type: "POST",
                    data: {
                        edit_id: edit_id
                    },
                    success: function(reponse) {
                        data = JSON.parse(reponse);
                        //    console.log(data)
                        $("#id").val(data.idPerc);
                        $("#details_eleve").text("Elève : " + data.nom + " " + data.postnom + " " + data.prenom + "     Classe: " + data.classe);
                        $("#idFrais").val(data.idFrais);
                        $("#montant").val(data.montant_percu);
                        $("#date").val(data.date_perception);
                        //    $("#sexe").val(data.sexe);
                        //    $("#date_naissance").val(data.date_naissance);
                        //    $("#lieu_naissa").val(data.lieu_naissance)
                        //    $("#classe").val(data.classe);
                    }
                })
            });
            /** Modification des donnees */
            $("#update").click(function(e) {
                if ($("#edit-form-data")[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                        url: "actions/actionRegistre.php",
                        type: "POST",
                        data: $("#edit-form-data").serialize() + "&action=update",
                        success: function(reponse) {
                            console.log(reponse);
                            Swal.fire(
                                'Felicitation!',
                                ' modification reussi !',
                                'success'
                            )
                            $("#editModal").modal('hide');
                            $("#edit-form-data")[0].reset();
                            showAllUser();
                        }
                    });
                }
            })
            /** Fonction Supprimer de la table */
            $("body").on('click', '.deleteBtn', function(e) {
                e.preventDefault();
                var tr = $(this).closest('tr');
                del_id = $(this).attr('id');
                Swal.fire({
                    title: 'Voulez-vous supprimer cette information ?',
                    text: "une fois supprimer vous ne l'aurez plus !!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes,Delete !!!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "actions/actionRegistre.php",
                            type: "POST",
                            data: {
                                del_id: del_id
                            },
                            success: function(reponse) {
                                tr.css('background-color', '#ff6666')
                                Swal.fire(
                                    'Felicitation!!!',
                                    'Suppression effectuée avec success !',
                                    'success'
                                )
                                showAllUser();
                            }
                        });
                    }
                })
            })
            /** Info plus */
            $("body").on("click", '.infoBtn', function(e) {
                e.preventDefault();
                info_id = $(this).attr('id');
                $.ajax({
                    url: "actions/actionRegistre.php",
                    type: "POST",
                    data: {
                        info_id: info_id
                    },
                    success: function(reponse) {
                        data = JSON.parse(reponse);
                        Swal.fire({
                            title: '<Strong class="text-left"> Code Eleve :' + data.id + '</Strong>',
                            type: "info",
                            html: '<b class="text-left">Noms:' + data.nom + " " + data.postnom + " " + data.prenom +
                                '</b></br><b class="text-left">Sexe:' + data.sexe + '</b></br><b class="text-left">Classe:' + data.classe + '</b>',
                            showCancelButton: true
                        })
                        showAllUser();
                    }
                })


            });
        });
    </script>
</body>

</html>
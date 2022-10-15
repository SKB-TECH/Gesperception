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

    <title>Gestion des frais </title>
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
                        <h5 class="mt-2 text-primary">Frais scolaire</h5>
                    </div>

                    <div class="clog-lg-6">
                        <button type="button" class="btn btn-primary m-1 float-right"><i class="fa fa-user-plus fa-lg" data-toggle="modal" data-target="#addModal"> Nouveau</i>
                        </button>&nbsp;&nbsp;&nbsp;
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
                    <h5 class="modal-title">Frais: Ajout</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" method="POST" id="form-data">
                        <div class="form-group">
                            <label for="libelle">Libelle</label>
                            <input type="text" name="libelle" class="form-control" placeholder="Libellé frais" required>
                        </div>


                        <div class="form-group">
                            <label for="montant">Montant</label>

                            <input type="number" min="1" name="montant" class="form-control" placeholder="Montant" required>
                        </div>

                        <div class="form-group ">
                            <label for="montant" class="col-12">Valeur de tranches (Laissez vide sinon) : </label>
                            <div class="d-flex">
                                <input type="number" min="0" name="tranche1" class="form-control col-4" placeholder="Tranche 1" id="montant" required>
                                <input type="number" min="0" name="tranche2" class="form-control col-4" placeholder="Tranche 2" id="montant" required>
                                <input type="number" min="0" name="tranche3" class="form-control col-4" placeholder="Tranche 3" id="montant" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Devise">Devise</label>
                            <select name="devise" class="form-control" required>
                                <option value="">Selectionner une devise monnetaire</option>
                                <option value="$">Dollars</option>
                                <option value="FC">Francs Congolais</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="insert" id="insert" class="btn btn-primary btn-block" value="ENREGISTRER">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modification Modal -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Frais : mise à jour</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" method="POST" id="edit-form-data">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label for="libelle">Libelle</label>
                            <input type="text" id="libelle" name="libelle" class="form-control" placeholder="Libellé frais" required>
                        </div>


                        <div class="form-group">
                            <label for="montqnt">Montant</label>

                            <input type="number" min="1" name="montant" class="form-control" placeholder="Montant" id="montant" required>
                        </div>

                        <div class="form-group ">
                            <label for="montant" class="col-12">Valeur de tranches (Laissez vide sinon) : </label>
                            <div class="d-flex">
                                <input type="number" min="0" name="tranche1" id="tranche1" class="form-control col-4" placeholder="Tranche 1" id="montant" required>
                                <input type="number" min="0" name="tranche2" id="tranche2" class="form-control col-4" placeholder="Tranche 2" id="montant" required>
                                <input type="number" min="0" name="tranche3" id="tranche3" class="form-control col-4" placeholder="Tranche 3" id="montant" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Devise">Devise</label>
                            <select name="devise" class="form-control" id="devise" required>
                                <option value="">Selectionner une devise monnetaire</option>
                                <option value="$">Dollars</option>
                                <option value="FC">Francs Congolais</option>
                            </select>
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
                    url: "actions/actionFrais.php",
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
                        url: "./actions/actionFrais.php",
                        type: "POST",
                        data: $("#form-data").serialize() + "&action=insert",
                        success: function(reponse) {
                            console.log(reponse)
                            Swal.fire(
                                'Felicitation!',
                                'Frias Ajouté(e) avec success !',
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
                    url: "./actions/actionFrais.php",
                    type: "POST",
                    data: {
                        edit_id: edit_id
                    },
                    success: function(reponse) {
                        data = JSON.parse(reponse);
                        console.log(data)
                        $("#id").val(data.id);
                        $("#libelle").val(data.libelle);
                        $("#montant").val(data.montant_frais);
                        $("#tranche1").val(data.tranche1);
                        $("#tranche2").val(data.tranche2);
                        $("#tranche3").val(data.tranche3);
                        $("#devise").val(data.devise);
                    }
                })
            });

            /** Modification des donnees */
            $("#update").click(function(e) {
                if ($("#edit-form-data")[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                        url: "./actions/actionFrais.php",
                        type: "POST",
                        data: $("#edit-form-data").serialize() + "&action=update",
                        success: function(reponse) {
                            console.log(reponse)
                            Swal.fire(
                                'Felicitation!',
                                ' Mise a jour reussie !',
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
                            url: "./actions/actionFrais.php",
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
                    url: "./actions/actionFrais.php",
                    type: "POST",
                    data: {
                        info_id: info_id
                    },
                    success: function(reponse) {
                        data = JSON.parse(reponse);
                        Swal.fire({
                            title: '<Strong class="text-left"> ID:  ' + data.id + '</Strong>',
                            type: "info",

                            html: '<b class="text-left">Libellé:  ' + data.libelle + '</b><br><b class="text-left">Montant total:  ' + data.montant_frais + ' ' +
                                data.devise + '</b><hr><b class="text-left">Premiere tranche:   ' + data.tranche1 + ' ' + data.devise + '</b><br><b class="text-left"> Deuxime tranche:  ' +
                                data.tranche2 + ' ' + data.devise + '</b><br><b class="text-left">Troisieme tranche:  ' + data.tranche3 + ' ' + data.devise + '</b>',

                            showCancelButton: true
                        })
                        showAllUser();
                        // console.log(info_id);
                    }
                })


            });
        });
    </script>
</body>

</html>
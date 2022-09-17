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

    <title>Gestion Paiements</title>
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
                                <?php $res=$taches->Compte("montant_percu",'perception');
                                    $data=$res->fetch();
                                    $entre=$data[0];
                                ?>
                                <h6 class="fs-2 font-bold"><?php echo($entre)?> &nbsp;FC</h6>
                                <p class="fs-5">ENTREES</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="p-3 bg-white  shadow-lg d-flex justify-content-around align-items-center rounded">
                            <div>
                                <?php $res=$taches->Compte("montant",'depense');
                                    $res=$res->fetch();
                                    $sortie1=$res[0];
                                ?>
                                <h6 class="fs-2 font-bold"><?php echo($sortie1)?> &nbsp;FC</h6>
                                <p class="fs-5">DEPENSES</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="p-3 bg-white  shadow-lg d-flex justify-content-around align-items-center rounded">
                        <div>
                                <?php $res=$taches->Compte("montant",'avance');
                                    $des=$res->fetch();
                                    $avance=$des[0]
                                ?>
                                <h6 class="fs-2 font-bold"><?php echo($avance)?> &nbsp;FC</h6>
                                <p class="fs-5">AVANCES</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="p-3 bg-white  shadow-lg d-flex justify-content-around align-items-center rounded">
                        <div>
                                <?php $res=$taches->Compte("net",'paie');
                                    $sal=$res->fetch();
                                    $paie=$sal[0]
                                ?>
                                <h6 class="fs-2 font-bold"><?php echo($paie)?> &nbsp;FC</h6>
                                <p class="fs-5">SALAIRES</p>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-2">
                        <div class="p-3 bg-white  shadow-lg d-flex justify-content-around align-items-center rounded">
                        <div style="font-weight: 400">
                                <h6 class="fs-2 font-bold"><?php echo($entre-$sortie1-$avance);?> &nbsp;FC</h6>
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
                        <h5 class="mt-2 text-primary">Paiement du personnel</h5>
                    </div>

                    <div class="clog-lg-6">
                        <button type="button" class="btn btn-primary m-1 float-right"><i class="fa fa-user-plus fa-lg" data-toggle="modal" data-target="#addModal"> Payer</i>
                        </button>&nbsp;&nbsp;&nbsp;
                        <a href="./Menus/actionsPaie.php?export=excel" class="btn btn-success m-1 float-lg"><i class="fa fa-table fa-lg"></i>
                            Exporter</a>&nbsp;&nbsp;&nbsp;
                        <a href="#" class="btn btn-danger m-1 float-lg"><i class="fa fa-table fa-lg"></i>
                            LISTE PDF    
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
                    <h5 class="modal-title">PAIEMENT PRIME DU PERSONNEL</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" method="POST" id="form-data">
                        <div class="form-group">
                            <input type="month" name="mois" class="form-control" id="mois" placeholder="mois" required>
                        </div>
                        <div class="form-group">
                            <select name="idagent" class="form-control" id="iagent" required>
                                <option value="Autres">Selectionner l'agent</option>
                                <?php
                                $data = $taches->selectalldata('enseignants');
                                while ($row = $data->fetch()) { ?>
                                    <option value='<?php echo $row['id'] ?>'><?php echo $row['noms'] ?></option>
                                <?php } ?>
                            </select>

                        </div>

                        <div class="form-group">
                            <input type="text" id="montant" name="montant" class="form-control" placeholder="montant" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="mituelle" name="mituelle" class="form-control" placeholder="mituelle" onchange="valeurs()" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="avancement" name="avance" class="form-control text-danger" value="0" required>
                        </div>

                        <div class="form-group">
                            <input type="text" id="netApayer" name="net"  class="form-control text-danger" placeholder="net A payer" required>
                        </div>

                        <div class="form-group">
                            <input type="date" name="dates" class="form-control" placeholder="dates" required>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="insert" id="insert" class="btn btn-primary btn-block" value="EFFECTUER LE PAIEMENT ">
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
                    <h5 class="modal-title">Modification Paiement</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" method="POST" id="edit-form-data">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <input type="month" id="mois" name="mois" class="form-control" id="mois" placeholder="mois" required>
                        </div>
                        <div class="form-group">
                            <select name="idagent" class="form-control" id="idagent" required>
                                <option value="Autres">Selectionner l'agent</option>
                                <?php
                                $data = $taches->selectalldata('enseignants');
                                while ($row = $data->fetch()) { ?>
                                    <option value='<?php echo $row['id'] ?>'><?php echo $row['noms'] ?></option>
                                <?php } ?>
                            </select>

                        </div>

                        <div class="form-group">
                            <input type="text" id="montant" name="montant" class="form-control" placeholder="montant" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="mituelle" name="mituelle" class="form-control" placeholder="mituelle" onchange="valeurs()" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="avancement" name="avance" disabled class="form-control text-danger" value="0" required>
                        </div>

                        <div class="form-group">
                            <input type="text" id="net" name="net" disabled class="form-control text-danger" placeholder="net A payer" required>
                        </div>

                        <div class="form-group">
                            <input type="date" name="dates" id="dates" class="form-control" placeholder="dates" required>
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
                    url: "./Menus/actionsPaie.php",
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
                        url: "./Menus/actionsPaie.php",
                        type: "POST",
                        data: $("#form-data").serialize() +"&action=insert",
                        success: function(reponse) {
                            Swal.fire(
                                'Felicitation!',
                                'Paiement effectue avec success !',
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
                    url: "./Menus/actionsPaie.php",
                    type: "POST",
                    data: {
                        edit_id: edit_id
                    },
                    success: function(reponse) {
                        data = JSON.parse(reponse);
                        //console.log(data.noms);
                        $("#id").val(data.idagent);
                        $("#idagent").val(data.noms);
                        $("#montant").val(data.montant);
                        $("#mituelle").val(data.mituelle);
                        $("#avancement").val(data.avance);
                        $("#net").val(data.net);
                        $("#mois").val(data.mois);
                        $("#dates").val(data.dates);

                    }
                })
            });

            /** Modification des donnees */
            $("#update").click(function(e) {
                if ($("#edit-form-data")[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                        url: "./Menus/actionsPaie.php",
                        type: "POST",
                        data: $("#edit-form-data").serialize() + "&action=update",
                        success: function(reponse) {
                            Swal.fire(
                                'Felicitation!',
                                'Paiement Modifier avec success !',
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
                            url: "./Menus/actionsPaie.php",
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

            // on change search
            $("#iagent").on("change", function() {
                var idagent = $(this).val();
                var mois = $("#mois").val();
                if (idagent && mois) {
                    $.ajax({
                        type: 'POST',
                        url: "./Menus/actionsPaie.php",
                        data: {
                            'idagent': idagent,
                            'mois': mois
                        },

                        success: function(reponse) {

                            data = JSON.parse(reponse);
                            $('#avancement').val(data.montant);


                        }

                    })
                }

            })

            /** Info plus */
            $("body").on("click", '.infoBtn', function(e) {
                e.preventDefault();
                info_id = $(this).attr('id');
                $.ajax({
                    url: "./Menus/actionsPaie.php",
                    type: "POST",
                    data: {
                        info_id: info_id
                    },
                    success: function(reponse) {
                        data = JSON.parse(reponse);
                        Swal.fire({
                                title: '<Strong class="text-left"> IDAGENT:' + data.idagent + '</Strong>',
                                type: "info",
                                html: '<b class="text-left">Montant:' + data.montant + '</b></br><b class="text-left">Mituelle:' + data.mituelle + '</b></br><b class="text-left">Avance:' + data.avance + '</b></br><b class="text-left">Net a payer:' + data.net + '</b>',
                                showCancelButton: true

                            }

                        )

                        showAllUser();
                        console.log(info_id);
                    }
                })


            });




        });
    </script>
    <script src="../js/script.js"></script>
</body>

</html>
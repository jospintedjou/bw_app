<?php
/* @var $this yii\web\View */

use kartik\tabs\TabsX;
use yii\helpers\Url;
use yii\web\Session;

$this->registerCssFile('css/toastr.min.css');
$this->registerJsFile('js/toastr.min.js');
?>
<style>
    #36{
        background:black;
    }
</style>
<div class="row" style="margin-top:4%; min-height: 800px; background: #ffffff;">
    <div class="col-lg-10 col-md-10 col-sm-10" style="background: #ffffff;">
        <?php
        $nombreVins = count($liste);
        for ($i = 0; $i < $nombreVins; $i++) {
            if ($i == 0) {
                $item = ['label' => $liste[$i]['category'], 'content' => $liste[$i]['contenu'], 'bordered' => true, 'active' => true];
            } else {
                $item = ['label' => $liste[$i]['category'], 'content' => $liste[$i]['contenu'], 'bordered' => true, 'headerOptions' => ['style' => 'font-weight:bold']];
            }
            $listeV[] = $item;
        }


        echo TabsX::widget([
            'position' => TabsX::POS_LEFT,
            'align' => TabsX::ALIGN_LEFT,
            'items' => $listeV,
        ]);
        ?>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2">
        <div class="row" style="height:30px; margin-top: 5%;background: #5bc0de;">
            <center><strong style="margin-top:45px;margin-top: 25%; color: #ffffff; font-weight: bold;font-size: 1.6em;">Voir le Panier</strong></center>
        </div>
        <div class="row bg-info">
            <div class="row">
                <center><a id="voirPanier" href="#" data-toggle="modal" data-target="#pannier"><img class="img-circle img-responsive" style="height:170px; width:170px;margin-left:0%;" src="uploads/panier1.jpg" alt="panier"/></a></center>
            </div>
            <div  style="margin-top: 3%; font-weight: bold; font-size: 1em; color:#ffffff;background:#5bc0de; ">
                <center>Boissons:<i style="color: black; font-weight: bold; font-size: 1.2em;"></i></center>
            </div>
            <div  style="margin-top: 3%; font-weight: bold; font-size: 1em; color:#ffffff;background:#5bc0de; ">
                <center>Entieres: <i class='boissonsEntieres' style="color: black; font-weight: bold; font-size: 1.2em;"> +3</i></center>
            </div>
            <div  style="margin-top: 3%; font-weight: bold; font-size: 1em; color:#ffffff;background:#5bc0de; ">
                <center>Demies: <i class="demieBoisson" style="color: black; font-weight: bold; font-size: 1.2em;"> +3</i></center>
            </div>
            <div  style="margin-top: 3%; font-weight: bold; font-size: 1em; color:#ffffff;background:#5bc0de; ">
                <center>Verres: <i class="verre" style="color: black; font-weight: bold; font-size: 1.2em;"> +3</i></center>
            </div>
            <div  style="margin-top: 3%; font-weight: bold; font-size: 1em; color:#ffffff;background:#5bc0de; ">
                <center>Conso:<i class="conso" style="color: black; font-weight: bold; font-size: 1.2em;"> +3</i></center>
            </div>
            <div  style="margin-top: 3%; font-weight: bold; font-size: 1em; color:#ffffff;background: #5bc0de; ">
                <center>repas: <i class="repas" style="color: black; font-weight: bold; font-size: 1.2em;"> +7</i></center>
            </div>
            <div  style="margin-top: 3%; font-weight: bold; font-size: 1em; color:#ffffff;background:#5bc0de; ">
                <center>Tabac: <i class="tabac" style="color: black; font-weight: bold; font-size: 1.2em;">+1</i></center>
            </div>
        </div>

    </div> 
</div>


<div id="pannier" class="modal fade" role="dialog" >
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header" style="background:#5bc0de;color:#ffffff;">
                <button type="button" id="fermerPanier" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Liste des Produits de la commande</h4>
            </div>
            <div class="modal-body">
                <form class="row form-horizontal">
                    <div class="row form-group">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4" id="listeClientsCommande">
                        </div>

                        <div class="col-lg-offset-6 col-lg-3 col-md-offset-4 col-md-4 col-sm-offset-4 col-sm-4 col-xs-offset-4 col-xs-4" id="listeTablesCommande">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-highlight">
                                <thead>
                                <th style="font-weight:bold;color:#ffffff;background:#2372d3;">Nature</th>
                                <th style="font-weight:bold;color:#ffffff;background:#2372d3;">Nom</th>
                                <th style="font-weight:bold;color:#ffffff;background:#2372d3;">Qtté Entier</th>
                                <th style="font-weight:bold;color:#ffffff;background:#2372d3;">Qtté Verre</th>
                                <th style="font-weight:bold;color:#ffffff;background:#2372d3;">Qtté Conso</th>
                                <th style="font-weight:bold;color:#ffffff;background:#2372d3;">Prix</th>
                                </thead>
                                <tbody id="contenuPanier">


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row form-group" align="right">
                        <a type="button" class="btn btn-sm" id="passerCommande"  style="background:#b62810;color:#ffffff;font-weight:bold;">commander</a>
                        <a href="#" class="btn btn-info btn-sm" id="annulerCommande">Annuler la cammande</a>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="background:#5bc0de;color:#ffffff; height: 30px;">

            </div>
        </div>

    </div>
</div>



<script>
    $(document).ready(function () {

        //cette fonction permet de faire la mise a jour du menu de l'IHM de listing des produits par categuorie
        function majMenu() {
            var menus = $('#w0').find('li');
            menus.each(function () {
                $(this).css({background: '#5bc0de'});
                var $fils = $(this).children('a');
                if ($(this).hasClass('active')) {
                    if ($fils.attr('ria-expanded')) {
                        $fils.css({color: 'black'});
                    }
                } else {
                    $fils.css({color: '#fff'});
                }

            });
        }
        majMenu();
        function OnCommandHoverAnimation() {
            //au survol sur le bouton pour choisir le produit a commander
            $('.btn').hover(function () {
                $(this).css('background', 'rgba(38,37,36,1)');
            }, function () {
                $(this).css("background-color", "#b62810");
            });
            // lorsqu'un produit est selectionne
            $('.btn').select(function () {
                $(this).css('background', 'black');
                alert('ok cool');
            });
            $('.nomProduit').hover(function () {
                $(this).css('color', "#b62810");
            }, function () {
                $(this).css("color", "#808080");
            });
        }

//        //OnCommandHoverAnimation();
//
        function ajouterUneBouteilleEntiere($idProduit) {
            $.ajax({
                url: 'http://localhost/seintra/trunk/black_white/frontend/web/index.php?r=order/order/infos&idProduit=' + $idProduit,
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    if (data === 1) {
                        toastr["success"]("1 boisson a ete ajoutee a la commande", "commande");
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                        nbBouteillesEntieres++;
                        $('.boissonsEntieres').text(nbBouteillesEntieres).css('color', 'yellow');
                    } else {
                        toastr["warning"]("le stock du produit est epuise", "commande")

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                },
                error: function () {
                    alert('echec de la requete');
                }
            });
        }


        function ajouterUneDemieBouteille($idProduit) {
            $.ajax({
                url: 'http://localhost/seintra/trunk/black_white/frontend/web/index.php?r=order/order/demiebouteille&idProduit=' + $idProduit,
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    if (data === 1) {
                        toastr["info"]("1 demie bouteille a ete ajoutee a la commande", "commande");
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                        nbDemieBouteilles++;
                        $('.demieBoisson').text(nbDemieBouteilles).css('color', 'yellow');
                    } else {
                        toastr["warning"]("impossible de servir une demie bouteille", "commande")

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                    }
                },
                error: function () {
                    alert('echec de la requete');
                }
            });
        }


        function ajouterUnverre($idProduit) {
            $.ajax({
                url: 'http://localhost/seintra/trunk/black_white/frontend/web/index.php?r=order/order/verre&idProduit=' + $idProduit,
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    if (data === 1) {
                        toastr["info"]("1 verre a ete ajoutee a la commande", "commande");
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                        nbVerres++;
                        $('.verre').text(nbVerres).css('color', 'yellow');
                    } else {
                        toastr["warning"]("les conso sont epuisées pour ce produit", "commande")

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                },
                error: function () {
                    alert('echec de la requete');
                }
            });
        }

        function ajouterConso($idProduit) {
            $.ajax({
                url: 'http://localhost/seintra/trunk/black_white/frontend/web/index.php?r=order/order/conso&idProduit=' + $idProduit,
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    if (data === 1) {
                        toastr["info"]("1 conso a ete ajoutee a la commande", "commande");
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                        nbConso++;
                        $('.conso').text(nbConso).css('color', 'yellow');
                    } else {
                        toastr["warning"]("les conso sont epuisées pour ce produit", "commande")

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                },
                error: function () {
                    alert('echec de la requete');
                }
            });
        }


        //cette fonction effectue l'ajout d'un repas 
        function ajouterRepas($idProduit) {
            $.ajax({
                url: 'http://localhost/seintra/trunk/black_white/frontend/web/index.php?r=order/order/repas&idProduit=' + $idProduit,
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    if (data === 1) {
                        toastr["info"]("1 repas a ete ajouté a la commande", "commande");
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                        nbRepas++;
                        $('.repas').text(nbRepas).css('color', 'yellow');
                    } else {
                        toastr["warning"]("ce repas n'est pas disponible", "commande");

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                    }
                },
                error: function () {
                    alert('echec de la requete');
                }
            });
        }

        //cette fonction va permettre de passer une commande
        function passerCommande() {
            $.ajax({
                url: 'http://localhost/seintra/trunk/black_white/frontend/web/index.php?r=order/order/saveorder',
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    if (data != null && data == 1) {
                        toastr["success"]("commande prise en compte avec succès!!!", "COMMANDE")

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    } else {
                        toastr["error"]("la commande n'a pas été envoyée", "COMMANDE")

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                },
                error: function () {
                    toastr["error"]("la commande n'a pas été envoyée", "COMMANDE")

                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                }
            });
        }

        //cette fonction permet d'ajouter un tabac dans la commande
        function ajouterTabac($idProduit) {
            $.ajax({
                url: 'http://localhost/seintra/trunk/black_white/frontend/web/index.php?r=order/order/tabac&idProduit=' + $idProduit,
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    if (data === 1) {
                        toastr["info"]("1 tabac a ete ajouté a la commande", "commande");
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                        nbTabac++;
                        $('.tabac').text(nbTabac).css('color', 'yellow');
                    } else {
                        toastr["warning"]("ce tabac n'est pas disponible", "commande");

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                    }
                },
                error: function () {
                    alert('echec de la requete');
                }
            });
        }

        //cette fonction charge la liste des clients dans le panier lors de la creation de la commande du client par la servante sur tablette
        function ajouterClient() {
            $.ajax({
                url: 'http://localhost/seintra/trunk/black_white/frontend/web/index.php?r=order/order/listerclients',
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    if (data != null) {
                        var $liste = data, htmlSelect = '<select class="form-control">';
                        htmlSelect += '<option value="" selected="selected">--customer--</option>';
                        for (var $i = 0; $i < $liste.length; $i++) {
                            var client = $liste[$i];
                            htmlSelect += '<option value="' + client.id_client + '">' + client.nom + '</option>';
                        }
                        htmlSelect += '</select>';
                    }
                    $('#listeClientsCommande').html(htmlSelect);
                },
                error: function () {
                    alert('echec de la requete de listing des clients');
                }
            });
        }

        //cette fonction charge la liste des tables dans le panier lors de la prise d'une commande 
        function ajouterTables() {
            $.ajax({
                url: 'http://localhost/seintra/trunk/black_white/frontend/web/index.php?r=order/order/listertables',
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    if (data != null) {
                        var $liste = data, htmlSelect = '<select class="form-control">';
                        htmlSelect += '<option value="" selected="selected">--Table--</option>';
                        for (var $i = 0; $i < $liste.length; $i++) {
                            var table = $liste[$i];
                            htmlSelect += '<option value="' + table.id_table + '">' + table.nom + '</option>';
                        }
                        htmlSelect += '</select>';
                    }
                    $('#listeTablesCommande').html(htmlSelect);
                },
                error: function () {
                    alert('echec de la requete de listing des clients');
                }
            });
        }


        //initialisation des elements du menu panier au niveau de la page des commandes
        var nbDemieBouteilles = 0;
        var nbBouteillesEntieres = 0;
        var nbVerres = 0;
        var nbConso = 0;
        var nbRepas = 0;
        var nbTabac = 0;
        $('.boissonsEntieres').text(nbBouteillesEntieres).css('color', 'yellow');
        $('.demieBoisson').text(nbDemieBouteilles).css('color', 'yellow');
        $('.verre').text(nbVerres).css('color', 'yellow');
        $('.conso').text(nbConso).css('color', 'yellow');
        $('.repas').text(nbRepas).css('color', 'yellow');
        $('.tabac').text(nbTabac).css('color', 'yellow');
        //evenement pour le choix d'une demie bouteille d'un produit
        $('.btn.DemieBouteille').click(function () {

            var elt = $(this);
            var idProduit = elt.attr('id');
            ajouterUneDemieBouteille(idProduit);
        });
        //evenement pour le choix d'une bouteille entiere d'un produit
        $('.btn.bouteilleEntiere').click(function () {
            var elt = $(this);
            var idProduit = elt.attr('id');
            ajouterUneBouteilleEntiere(parseInt(idProduit));
//            var prixProduit = elt.parent('center').parent('a').children('.prixBouteille');
        });
        //evenement pour le choix d'un verre entier d'un produit
        $('.btn.Verre').click(function () {
            var elt = $(this);
            var idProduit = elt.attr('id');
            ajouterUnverre(parseInt(idProduit));
        });
        //evenement pour le choix d'une conso d'un produit
        $('.btn.Conso').click(function () {
            var elt = $(this);
            var idProduit = elt.attr('id'); //alert(idProduit);
            ajouterConso(parseInt(idProduit));
        });
        //evenement pour le choix d'un repas
        $('.btn.cuisine').click(function () {
            var elt = $(this);
            var idProduit = elt.attr('id');
            ajouterRepas(idProduit);
        });

        //evenement pour le choix d'un tabac
        $('.btn.tabacPanier').click(function () {
            var elt = $(this);
            var idProduit = elt.attr('id');
            ajouterTabac(idProduit);
        });

        //cet evenement permet de passer une commande
        $('#passerCommande').click(function () {
            passerCommande();
        });



        //evenement pour la construction du panier pour une commande
        $('#voirPanier').click(function () {
            ajouterClient();
            ajouterTables();
            $.ajax({
                url: 'http://localhost/seintra/trunk/black_white/frontend/web/index.php?r=order/order/commande',
                type: 'POST',
                dataType: 'JSON',
                success: function (data, whensuccess) {
                    var HtmlPanier = '';
                    if (data != null) {
                        var reponse = data.liste, cpt = 0, $total = data.prixTotal, $totalEnt = 0, $totalVerre = 0, $totalConso = 0;
                        
                        for (cpt = 0; cpt < reponse.length; cpt++) {
                            var $type1 = 0, $type2 = 0, $type3 = 0, $type4 = 0, $type5 = 0, $type6 = 0;
                            var cc = reponse[cpt];
                            
                            HtmlPanier += '<tr id="' + cc.idProduit + '">';
                            $totalEnt += cc.q1;
                            $totalVerre += cc.q2;
                            $totalConso += cc.q3;

                            //controle des types et association des prix de base
                            if (cc.nature === "boisson") {
                                HtmlPanier += '<td><img style="width:50px;height:25px;" src="uploads/cabernet_sauvignon.jpg" alt="img"/></td>';
                                if (cc.prixUnitaireBtlle !== null) {
                                    $type1 = 1;
                                }
                                if (cc.prixUnitaireVerre !== null) {
                                    $type2 = 1;
                                }
                                if (cc.prixUnitaireConso !== null) {
                                    $type3 = 1;
                                }
                                if (cc.prixDemie !== null) {
                                    $type4 = 1;
                                }
                            }
                            if (cc.nature === "repas") {
                                HtmlPanier += '<td><img style="width:50px;height:25px;" src="uploads/repas.png" alt="img"/></td>';
                                if (cc.prix!== null){
                                    $type5 = 1;
                                }
                                    
                            }
                            if (cc.nature === "tabac") {
                                HtmlPanier += '<td><img style="width:40px;height:25px;" src="uploads/cigare.jpg" alt="img"/></td>';
                                if (cc.prixUnitaireTabac !== null){
                                     $type6 = 1;
                                     var $prixt=cc.prixUnitaireTabac;
                                      
                                }
                                   
                            }
                            
                            
                            
                            HtmlPanier += '<td style="background:#5bc0de;color:#ffffff;font-weight:bold">' + cc.nom + '</td>';
                            
                            if (parseInt(cc.q1) <= 0) { 
                                HtmlPanier += '<td><input disabled   class="form-control" style="width:60px;font-weight:bold;color:black;" type="number" value="' + cc.q1 + '"/></td>';
                            } else {
                               
                                if ($type1 === 1) {
                                    
                                    HtmlPanier += '<td><input min="0" id="' + cc.prixUnitaireBtlle + '"  class="form-control" style="width:60px;font-weight:bold;color:black;" type="number" value="' + cc.q1 + '"/></td>';
                                } else {
                                    if ($type5 === 1) {
                                        
                                        HtmlPanier += '<td><input min="0" id="' + cc.prixUnitaireRepas+ '"  class="form-control" style="width:60px;font-weight:bold;color:black;" type="number" value="' + cc.q1 + '"/></td>';
                                    } else {
                                                
                                        if ($type6 === 1) {
                                            
                                            HtmlPanier += '<td><input min="0" id="' +$prixt+ '"  class="form-control" style="width:60px;font-weight:bold;color:black;" type="number" value="' + cc.q1 + '"/></td>';
                                        }
                                    }
                                }
                            }
                            if (parseInt(cc.q2) > 0) {
                                if ($type2 === 1) {
                                    HtmlPanier += '<td><input min="0" id="' + cc.prixUnitaireVerre + '"   class="form-control" style="width:50px;font-weight:bold;color:black;" type="number" value="' + cc.q2 + '"/></td>';
                                } else {
                                    HtmlPanier += '<td><input   class="form-control" style="width:50px;font-weight:bold;color:black;" type="number" value="' + cc.q2 + '"/></td>';
                                }

                            } else {
                                HtmlPanier += '<td><input disabled  class="form-control" style="width:50px;font-weight:bold;color:black;" type="number" value="' + cc.q2 + '"/></td>';
                            }
                            if (parseInt(cc.q3) > 0) {
                                if ($type3 === 1) {
                                    HtmlPanier += '<td><input min="0" id="' + cc.prixUnitaireConso + '"   class="form-control" style="width:50px;font-weight:bold;color:black;" type="number" value="' + cc.q3 + '"/></td>';
                                } else {
                                    HtmlPanier += '<td><input   class="form-control" style="width:50px;font-weight:bold;color:black;" type="number" value="' + cc.q3 + '"/></td>';
                                }
                            } else {
                                HtmlPanier += '<td><input disabled  class="form-control" style="width:50px;font-weight:bold;color:black;" type="number" value="' + cc.q3 + '"/></td>';
                            }
                            HtmlPanier += ' <td class="total" style="background:#5bc0de;color:#ffffff;font-weight:bold">' + cc.prix + '</td></tr>';
                        }
                        HtmlPanier += '<tr><td style="font-weight:bold;color:#ffffff;background:#2372d3;">TOTAL</td><td style="font-weight:bold;color:#ffffff;background:#2372d3;"></td><td style="font-weight:bold;color:#ffffff;background:#2372d3;"></td><td style="font-weight:bold;color:#ffffff;background:#2372d3;"></td><td style="font-weight:bold;color:#ffffff;background:#2372d3;"></td><td class="totalEnsmble" style="font-weight:bold;color:yellow;background:#2372d3;">' + $total + '</td></tr>';
                        $('#contenuPanier').html(HtmlPanier);

                        var $p = $('#contenuPanier').find('tr');
                        $p.each(function () {
                            var $inputs = $(this).find('input');
                            $inputs.each(function () {
                                var $ancienneValeur = $(this).val();
                                
                                $($(this)).change(function ($ancienneValeur) {
                                    var $nvValeur = $(this).val();
                                    if ($nvValeur !== $ancienneValeur) {
                                        var  $prixU = parseInt($(this).attr('id'));
                                        var $coutTotal = $nvValeur * $prixU;
                                        $(this).parent().parent('tr').children('.total').text($coutTotal);
                                        
                                         var inp = $('#contenuPanier').find('.total');
                                         var nvTotal=0;
                                         inp.each(function(){
                                             nvTotal+=(parseInt($(this).text()));
                                         });
                                         $('.totalEnsmble').text(nvTotal);

                                    }

                                });
                            });
                        });
                    }


                },
                error: function () {
                    alert('echec de la requete');
                }
            });
        });
        //evenement pour annuler une commande
        $('#annulerCommande').click(function () {
            $.ajax({
                url: 'http://localhost/seintra/trunk/black_white/frontend/web/index.php?r=order/order/erasepanier',
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    if (data != null) {
                        if (data == 1) {
                            var HtmlMaj = '';
                            $('#contenuPanier').html(HtmlMaj);
                            $('#fermerPanier').click();
                            nbDemieBouteilles = 0;
                            nbBouteillesEntieres = 0;
                            nbVerres = 0;
                            nbConso = 0;
                            nbRepas = 0;
                            nbTabac = 0;
                            $('.boissonsEntieres').text(nbBouteillesEntieres).css('color', 'yellow');
                            $('.demieBoisson').text(nbDemieBouteilles).css('color', 'yellow');
                            $('.verre').text(nbVerres).css('color', 'yellow');
                            $('.conso').text(nbConso).css('color', 'yellow');
                            $('.repas').text(nbRepas).css('color', 'yellow');
                            $('.tabac').text(nbTabac).css('color', 'yellow');

                            toastr["success"]("commande detruite avec succes", "commande");
                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": false,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            };
                        } else {
                            toastr["error"]("Erreur systeme", "commande");
                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": false,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            };
                        }
                    } else {
                        toastr["error"]("Erreur systeme", "commande")

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                },
                error: function () {
                    alert("error");
                }
            });
        });

    });

</script>

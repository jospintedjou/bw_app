/* 
 * 
 * @author fritz kenne
 * @name script pour la page de listing des produits et la commande du client
 */

   $(document).ready(function () {
        $('#passerCommande').hide();
        $('#annulerCommande').hide();

        //cette fonction permet de faire la mise a jour du menu de l'IHM de listing des produits par categuorie
        function majMenu() {
            var menus = $('#w0').find('li');
            menus.each(function () {
                $(this).css({background: '#d2eafd'});
                var $fils = $(this).children('a');
                if ($(this).hasClass('active')) {
                    if ($fils.attr('ria-expanded')) {
                        $fils.css({color: 'black'});
                    }
                } else {
                    $fils.css({color: 'black'});
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
                url: 'index.php?r=order/order/infos&idProduit=' + $idProduit,
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
                        $('.boissonsEntieres').text(nbBouteillesEntieres).css('color', 'red');
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
                url: 'index.php?r=order/order/demiebouteille&idProduit=' + $idProduit,
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
                        $('.demieBoisson').text(nbDemieBouteilles).css('color', 'red');
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
                url: 'index.php?r=order/order/verre&idProduit=' + $idProduit,
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
                        $('.verre').text(nbVerres).css('color', 'red');
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
                url: 'index.php?r=order/order/conso&idProduit=' + $idProduit,
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
                        $('.conso').text(nbConso).css('color', 'red');
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
                url: 'index.php?r=order/order/repas&idProduit=' + $idProduit,
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
                        $('.repas').text(nbRepas).css('color', 'red');
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
            var $commande = $('#contenuPanier').find('tr');
            var $listec = new Array();
            var $nombre = $commande.length;

            var $i = 0;
            $commande.each(function () {
                var $idProd = $(this).attr('id');
                var $nom = $(this).children('#nom').text();
                if (($(this).find('input[name=qteConso]').val()) === '') {
                    var $qtyC = 0;

                } else {
                    var $qtyC = $(this).find('input[name=qteConso]').val();
                }
                if ($(this).find('input[name=qteEntiere]').val() === '') {
                    var $qtyE = 0;
                } else {
                    var $qtyE = $(this).find('input[name=qteEntiere]').val()
                }

                if ($(this).find('input[name=qteVerre]').val() === '') {
                    var $qtyV = 0;
                } else {
                    var $qtyV = $(this).find('input[name=qteVerre]').val();
                }
                if ($(this).find('input[name=qteDemie]').val() === '') {
                    var $qtyD = 0;
                } else {
                    var $qtyD = $(this).find('input[name=qteDemie]').val();
                }

                var $prix = $(this).children('.total').text();
                if ($i < ($nombre - 1)) {
                    var param = {'id': parseInt($idProd), 'nom': $nom, 'quantiteEntiere': $qtyE, 'quantiteDemie': $qtyD, 'quantiteVerre': $qtyV, 'quantiteConso': $qtyC, 'prix': $prix};
                    $listec[$i] = param;
                }

                $i++;

            });

            var $client = $('#selectClients').val();
            var $table = $('#selectTables').val();
            var objetCommande = {'idclient': $client, 'idTable': $table, 'commande': $listec};

            $.ajax({
                url: 'index.php?r=order/order/save-order',
                type: 'POST',
                dataType: 'JSON',
                data: {param: JSON.stringify(objetCommande)},
                success: function (data) {

                    if (data != null) {
                        if (data === 2) {
                            toastr["error"]("vous devez choisir le client et la table pour cette commande", "COMMANDE")

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
                            if (data === 1) {
                                toastr["info"]("commande ok!", "COMMANDE")

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
                                $('#fermerPanier').click();
                                location.reload();
                            } else {
                                alert('echec requete');
                            }
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
                url: 'index.php?r=order/order/tabac&idProduit=' + $idProduit,
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
                        $('.tabac').text(nbTabac).css('color', 'red');
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
                url: 'index.php?r=order/order/listerclients',
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    if (data != null) {
                        var $liste = data, htmlSelect = '<select class="form-control" id="selectClients">';
                        htmlSelect += '<option value="default" selected="selected">----client----</option>';
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
                url: 'index.php?r=order/order/listertables',
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    if (data != null) {
                        var $liste = data, htmlSelect = '<select class="form-control" id="selectTables">';
                        htmlSelect += '<option value="default" selected="selected">----Table----</option>';
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

        //cette fonction permet de mettre a jour le panier
        function majPanier() {
            $.ajax({
                url: 'index.php?r=order/order/commande',
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    var HtmlPanier = '';
                    if (data != null) {
                        var reponse = data.liste, cpt = 0, $total = data.prixTotal, $totalEnt = 0, $totalVerre = 0, $totalConso = 0;

                        if (data.liste === undefined) {
                            $('#contenuPanier').html(HtmlPanier);
                            $('#passerCommande').hide();
                            $('#annulerCommande').hide();
                            toastr["error"]("votre panier doit contenir au moins un produit pour une commande !!!", "COMMANDE")

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
                            $('#passerCommande').show();
                            $('#annulerCommande').show();
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
                                    if (cc.prixUnitaireBtlle !== 0) {
                                        $type1 = 1;
                                    }
                                    if (cc.prixUnitaireVerre !== 0) {
                                        $type2 = 1;
                                    }
                                    if (cc.prixUnitaireConso !== 0) {
                                        $type3 = 1;
                                    }
                                    if (cc.prixDemie !== 0) {
                                        $type4 = 1;
                                    }
                                }
                                if (cc.nature === "repas") {
                                    HtmlPanier += '<td><img style="width:50px;height:25px;" src="uploads/repas.png" alt="img"/></td>';
                                    if (cc.prix !== null) {
                                        $type5 = 1;
                                    }

                                }
                                if (cc.nature === "tabac") {
                                    HtmlPanier += '<td><img style="width:40px;height:25px;" src="uploads/cigare.jpg" alt="img"/></td>';
                                    if (cc.prixUnitaireTabac !== null) {
                                        $type6 = 1;
                                        var $prixt = cc.prixUnitaireTabac;

                                    }

                                }



                                HtmlPanier += '<td id="nom" style="background:#a7b3b6;color:#ffffff;font-weight:bold">' + cc.nom + '</td>';

                                if (parseInt(cc.q1) <= 0) {
                                    HtmlPanier += '<td><input name="qteEntiere" min="1" max="1000" disabled   class="form-control prixEnt" style="width:60px;font-weight:bold;color:black;" type="number" value=" "/></td>';
                                } else {

                                    if ($type1 === 1) {


                                        HtmlPanier += '<td><input name="qteEntiere"  min="1" max="1000" id="' + cc.prixUnitaireBtlle + '"  class="form-control prixBouteille" style="width:60px;font-weight:bold;color:black;" type="number" value="' + cc.q1 + '"/></td>';


                                    } else {
                                        if ($type5 === 1) {
                                            if (cc.q1 <= 0) {
                                                HtmlPanier += '<td><input name="qteEntiere"  min="1" max="1000" class="form-control prixRepas" style="width:60px;font-weight:bold;color:black;" type="number" value="' + cc.q1 + '"/></td>';
                                            } else {
                                                HtmlPanier += '<td><input name="qteEntiere"  min="1" max="1000" id="' + cc.prixUnitaireRepas + '"  class="form-control prixRepas" style="width:60px;font-weight:bold;color:black;" type="number" value="' + cc.q1 + '"/></td>';
                                            }


                                        } else {

                                            if ($type6 === 1) {
                                                if (cc.q1 <= 0) {
                                                    HtmlPanier += '<td><input name="qteEntiere"  min="1" max="1000" id="' + $prixt + '"  class="form-control  prixTabac" style="width:60px;font-weight:bold;color:black;" type="number" value="' + cc.q1 + '"/></td>';
                                                } else {
                                                    HtmlPanier += '<td><input name="qteEntiere"  min="1" max="1000" id="' + $prixt + '"  class="form-control  prixTabac" style="width:60px;font-weight:bold;color:black;" type="number" value="' + cc.q1 + '"/></td>';
                                                }

                                            }
                                        }
                                    }
                                }

                                if (cc.q4 > 0) {
                                    HtmlPanier += '<td><input disabled name="qteDemie"  min="1" max="1000" id="' + cc.prixDemie + '"  class="form-control" style="width:60px;font-weight:bold;color:black;" type="number" value="1"/></td>';
                                } else {
                                    HtmlPanier += '<td><input disabled name="qteDemie" min="1" max="1000"  class="form-control" style="width:60px;font-weight:bold;color:black;" type="number"/></td>';
                                }
                                if (parseInt(cc.q2) > 0) {
                                    if ($type2 === 1) {
                                        HtmlPanier += '<td><input name="qteVerre" min="1" max="1000" id="' + cc.prixUnitaireVerre + '"   class="form-control prixVerre" style="width:60px;font-weight:bold;color:black;" type="number" value="' + cc.q2 + '"/></td>';
                                    } else {
                                        HtmlPanier += '<td><input name="qteVerre" min="1" max="1000"   class="form-control prixVerre" style="width:60px;font-weight:bold;color:black;" type="number" value="' + cc.q2 + '"/></td>';
                                    }

                                } else {
                                    HtmlPanier += '<td><input name="qteVerre" disabled   class="form-control prixVerre" style="width:60px;font-weight:bold;color:black;" type="number" value=" "/></td>';
                                }
                                if (parseInt(cc.q3) > 0) {
                                    if ($type3 === 1) {

                                        HtmlPanier += '<td><input min="1" max="1000" id="' + cc.prixUnitaireConso + '"   class="form-control prixConso" name="qteConso" style="width:60px;font-weight:bold;color:black;" type="number" value="' + cc.q3 + '"/></td>';
                                    } else {
                                        HtmlPanier += '<td><input min="1" max="1000"   name="qteConso"  class="form-control  prixConso" style="width:60px;font-weight:bold;color:black;" type="number" value="' + cc.q3 + '"/></td>';
                                    }
                                } else {
                                    HtmlPanier += '<td><input name="qteConso" disabled  class="form-control prixConso" style="width:60px;font-weight:bold;color:black;" type="number" value=""/></td>';
                                }
                                HtmlPanier += ' <td class="total" style="background:#a7b3b6;color:#ffffff;font-weight:bold">' + cc.prix + '</td>';
                                HtmlPanier += ' <td><center><a id="' + cc.idProduit + '" class="btn btn-xs supprimerProduit" style="background:#f04e5d; color:#fff;" href="#"><span class="glyphicon glyphicon-trash"></span></a></center></td></tr>';
                            }
                            HtmlPanier += '<tr><td class="entetePanier">TOTAL</td><td class="entetePanier"></td><td class="entetePanier"></td><td class="entetePanier"></td><td class="entetePanier"></td><td class="entetePanier"></td><td class="entetePanier"></td><td class="totalEnsmble" style="font-weight:bold;color:yellow;background:#2372d3;">' + $total + '</td></tr>';
                            $('#contenuPanier').html(HtmlPanier);

                            //evenement pour supprimer un produit de la commande
                            $('.btn.btn-xs.supprimerProduit').click(function () {
                                var $idProduit = $(this).attr('id');
                                supprimerProduitCommande($idProduit);
                            });




                            var $p = $('#contenuPanier').find('tr');
                            $p.each(function () {
                                var $inputs = $(this).find('input');
                                $inputs.each(function () {
                                    var $ancienneValeur = $(this).val();

                                    $($(this)).change(function () {

                                        var $nvValeur = $(this).val();
                                        
                                        if ($nvValeur !== $ancienneValeur) {
                                            var $prixE = 0, $prixD = 0;
                                            

                                            if ($(this).hasClass('form-control prixRepas') || $(this).hasClass('prixTabac') || $(this).hasClass('prixBouteille') || $(this).hasClass('prixVerre') || $(this).hasClass('prixConso')) {
                                                if (($nvValeur % 1) > 0 && ($nvValeur % 1) < 1) {
                                                    var $partieEnt = $nvValeur - ($nvValeur % 1);
                                                    $(this).val($partieEnt);
                                                }
//                                                if ($nvValeur < 0 || isNaN($nvValeur)) {
//                                                    alert($nvValeur);
//                                                    var $partieEnt = 1;
//                                                    $(this).val($partieEnt);
//                                                }
                                            } else {
                                                if (($nvValeur % 1) > 0 && ($nvValeur % 1) != 0.5 && ($nvValeur % 1) < 1) {
                                                    var $partieEnt = $nvValeur - ($nvValeur % 1);
                                                    $(this).val($partieEnt);
                                                }
                                                

                                            }

                                            //pensons maintenant a la mise a jour des prix sur le panier

                                            var parentTr = $(this).parent().parent().find('input');

                                            var $coutTotal = 0;

                                            parentTr.each(function () {
                                                if ($(this).attr('id')) {
                                                    var $p = $(this).attr('id');
                                                    var $valeur = $(this).val();
                                                    $coutTotal += parseInt($p) * parseInt($valeur);
                                                }
                                            });

                                            $(this).parent().parent('tr').children('.total').text($coutTotal);

                                            var inp = $('#contenuPanier').find('.total');
                                            var nvTotal = 0;
                                            inp.each(function () {
                                                nvTotal += (parseInt($(this).text()));
                                            });
                                            $('.totalEnsmble').text(nvTotal);

                                            //fin mise a jour des prix

                                        }

                                    });
                                });
                            });
                        }
                    }


                },
                error: function () {
                    alert('echec de la requete');
                }
            });

        }

        //cette fonction supprime le produit dont l'identifiant lui est donné de la commande
        function  supprimerProduitCommande($id) {
            $.ajax({
                url: 'index.php?r=order/order/supprimer&idProduit=' + $id,
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    if (data === 1) {
                        majPanier();
                        toastr["success"]("1 produit supprimé !!", "COMMANDE")

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


        //initialisation des elements du menu panier au niveau de la page des commandes
        var nbDemieBouteilles = 0;
        var nbBouteillesEntieres = 0;
        var nbVerres = 0;
        var nbConso = 0;
        var nbRepas = 0;
        var nbTabac = 0;
        $('.boissonsEntieres').text(nbBouteillesEntieres).css('color', 'red');
        $('.demieBoisson').text(nbDemieBouteilles).css('color', 'red');
        $('.verre').text(nbVerres).css('color', 'red');
        $('.conso').text(nbConso).css('color', 'red');
        $('.repas').text(nbRepas).css('color', 'red');
        $('.tabac').text(nbTabac).css('color', 'red');
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
            var idProduit = elt.attr('id');
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
            majPanier();
        });



        //fin de l'evenement

        //evenement pour annuler une commande
        $('#annulerCommande').click(function () {
            $.ajax({
                url: 'index.php?r=order/order/erasepanier',
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
                            $('.boissonsEntieres').text(nbBouteillesEntieres).css('color', 'red');
                            $('.demieBoisson').text(nbDemieBouteilles).css('color', 'red');
                            $('.verre').text(nbVerres).css('color', 'red');
                            $('.conso').text(nbConso).css('color', 'red');
                            $('.repas').text(nbRepas).css('color', 'red');
                            $('.tabac').text(nbTabac).css('color', 'red');

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
                            $('#passerCommande').hide();
                            $('#annulerCommande').hide();
                            location.reload();
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



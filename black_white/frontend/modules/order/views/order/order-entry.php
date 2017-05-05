<?php
/* @var $this yii\web\View */

use kartik\tabs\TabsX;
use yii\helpers\Url;
use yii\web\Session;

$this->registerCssFile('css/toastr.min.css');
$this->registerJsFile('js/toastr.min.js');
$this->registerJsFile('js/prendreCommande.js');
?>
<style>
    #36{
        background:black;
    }

    .menuPanier{
        margin-top: 0;
        font-weight: bold;
        font-size: 1em;
        color:black;
        background:rgb(210, 234, 253);
        border-top: 1px solid #ffffff;
        border-bottom: 1px solid #ffffff;

    }
    .entetePanier{
        font-weight:bold;
        color:#ffffff;
        background:#03a9f4;
    }
    .row.menuPanier{
     background:rgba(3,166,244,0.69);
     height: 60px; 
     margin-top: 0.8%;
     width: 12.2%;
     margin-left: 0.2%;
     
    }
    .row.menuPanier h1{
        margin-left: 15px;
        color: #ffffff;
    }
 
    
</style>
<div class="row" style="margin-top:4%; min-height: 800px; background: #ffffff;">
    <div class="col-lg-10 col-md-10 col-sm-10" style="background: #ffffff;margin-bottom: 6%;">
        <div class="row menuPanier">
            <h1>Menu</h1>
        </div>
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
        <div class="row" style="height:30px; margin-top: 5%;background:rgba(3,166,244,0.69);">
            <center><strong style="margin-top:45px;margin-top: 25%; color: #ffffff; font-weight: bold;font-size: 1.6em;">Voir le Panier</strong></center>
        </div>
        <div class="row bg-info">
            <div class="row" style="background:#252c3b;width:95%;margin-left: 1%;margin-top: 1%;margin-bottom: 1%;">
                <center><a id="voirPanier" href="#" data-toggle="modal" data-target="#pannier"><img class="img-circle img-responsive" style="height:90px; width:90px;margin-left:0%; margin-top:2%;margin-bottom: 2%;" src="uploads/panier1.jpg" alt="panier"/></a></center>
            </div>
            <div class="menuPanier">
                <center>Boissons:<i style="color: black; font-weight: bold; font-size: 1.2em;"></i></center>
            </div>
            <div class="menuPanier" >
                <center>Entieres: <i class='boissonsEntieres' style="color: black; font-weight: bold; font-size: 1.2em;"> +3</i></center>
            </div>
            <div class="menuPanier">
                <center>Demies: <i class="demieBoisson" style="color: black; font-weight: bold; font-size: 1.2em;"> +3</i></center>
            </div>
            <div class="menuPanier">
                <center>Verres: <i class="verre" style="color: black; font-weight: bold; font-size: 1.2em;"> +3</i></center>
            </div>
            <div class="menuPanier">
                <center>Conso:<i class="conso" style="color: black; font-weight: bold; font-size: 1.2em;"> +3</i></center>
            </div>
            <div class="menuPanier">
                <center>repas: <i class="repas" style="color: black; font-weight: bold; font-size: 1.2em;"> +7</i></center>
            </div>
            <div class="menuPanier">
                <center>Tabac: <i class="tabac" style="color: black; font-weight: bold; font-size: 1.2em;">+1</i></center>
            </div>
        </div>

    </div> 
</div>


<div id="pannier" class="modal fade" role="dialog" >
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header" style="background:#d7e2e6;color:#0080ff;">
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
                                <th class="entetePanier">Nature</th>
                                <th class="entetePanier">Nom</th>
                                <th class="entetePanier">Qtté Entier</th>
                                <th class="entetePanier">Qtté Demie</th>
                                <th class="entetePanier">Qtté Verre</th>
                                <th class="entetePanier">Qtté Conso</th>
                                <th class="entetePanier">Prix</th>
                                <th class="entetePanier">Action</th>
                                </thead>
                                <tbody id="contenuPanier">


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row form-group" align="right">
                        <a type="button" class="btn btn-sm btn-primary" id="passerCommande"  style=" color:#ffffff;font-weight:bold;"><span class="glyphicon glyphicon-ok"></span> commander</a>
                        <a href="#" class="btn btn-sm" id="annulerCommande" style="background:#f04e5d; color:#fff;"><span class="glyphicon glyphicon-trash"></span> Annuler la cammande</a>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="background:#d7e2e6;color:#ffffff; height: 30px;">

            </div>
        </div>

    </div>
</div> 

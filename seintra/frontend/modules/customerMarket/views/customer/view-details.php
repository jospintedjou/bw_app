<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Details du client';
?>

<div class="right_col" role="main">                  
    <div class="">
        <div class="page-title">

            <div style="margin-left: 90%">
                <h2> <?= Html::a('<i class="glyphicon glyphicon-menu-left"></i><i class="glyphicon glyphicon-menu-left"></i>', ['customer/view-customers'], ['class' => 'profile-link']) ?> </h2>
            </div>  
            <div class="title_left" style="width:70%">
                <h2 align="center">DETAILS SUR LE CLIENT <strong> <?= $customer; ?></strong>  </h2>                
            </div>  
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="clearfix"></div>
                    </div>
                    <div style="border-radius: 200px">
                        <ul class="nav nav-tabs">
                            <li class="active" style="background-color: #EDEDED;border-radius: 200px"><a href="#infos" data-toggle="tab"> INFORMATIONS SUR LE CLIENT</a></li>
                            <?php if (Yii::$app->user->identity->role != 'DEV') { ?> 
                                <li style="background-color:#EDEDED;border-radius: 200px"><a href="#contacts" data-toggle="tab"> PRISES DE CONTACT</a></li>
                                <li style="background-color:#EDEDED;border-radius: 200px"><a href="#marches" data-toggle="tab"> MARCHES</a></li>                    
                                <?php
                            } 
                                ?>
                            </ul>

                        </div>
                        <div class="tab-content clearfix">
                           <?php if (Yii::$app->user->identity->role != 'DEV') { ?> 
                                <div class="tab-pane" id="contacts">
                                    <div class="x_content">
                                        <!-- start Markets  list -->

                                        <?php if ($contacts != null) { ?> 
                                        
                                        <br><br>
                                            <table id="" class="table table-striped table-bordered" style="width: 100%" >
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>                                                                
                                                        <th>Motif</th>                                         
                                                        <th>Debouche</th>
                                                        <th>Moyen</th>
                                                        <th>Commercial Traitant</th>

                                                    </tr>
                                                <tbody>
                                                    <?php
                                                    foreach ($contacts as $contact) {
                                                        ?> 

                                                        <tr>
                                                            <td>
                                                                <?= $contact['date']; ?> 
                                                            </td>
                                                            <td>
                                                                <?= $contact['motif']; ?>
                                                            </td>
                                                            <td>
                                                                <?= $contact['debouche']; ?>
                                                            </td>
                                                            <td>
                                                                <?= $contact['moyen']; ?>
                                                            </td>
                                                            <td>
                                                                <?= $contact['nom'] . " " . $contact['prenom']; ?>
                                                            </td>

                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>

                                                <div align="center">
                                                    <br><br>
                                                    <div class="label label-info"  style="font-size: 100%">AUCUNE PRISE DE CONTACT A AFFICHER.</div>
                                                </div>

                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <div class="tab-pane" id="marches">
                                    <div class="x_content">
                                        <!-- start Markets  list -->

                                        <?php
                                        if ($markets != null) {
                                            if ($model->type == 'prive') {
                                                ?>   
                                        <br><br>
                                                <table id="" class="table table-striped table-bordered" style="width: 100%"  >
                                                    <thead>
                                                        <tr>
                                                            <th>Intiule</th>                                                                
                                                            <th>Etat</th>                                         
                                                            <th>date de demande de cotation</th>
                                                            <th>date de depot de cotation</th>
                                                            <th>date de reponse</th>

                                                        </tr>
                                                    <tbody>
                                                        <?php
                                                        foreach ($markets as $market) {
                                                            ?> 
                                                            <tr>
                                                                <td>
                                                                    <?= HTML::Encode($market['intitule']); ?> 
                                                                </td>
                                                                <td>
                                                                    <?= HTML::Encode($market['etat']); ?>
                                                                </td>
                                                                <td>
                                                                    <?= HTML::Encode($market['date_dmd_cotation']); ?>
                                                                </td>
                                                                <td>
                                                                    <?= HTML::Encode($market['date_depot_cotation']); ?>
                                                                </td>
                                                                <td>
                                                                    <?= HTML::Encode($market['date_reponse']); ?>
                                                                </td>

                                                            </tr>

                                                        <?php }
                                                        ?>
                                                    </tbody>
                                                </table>
                                                <?php
                                            } else
                                            if ($model->type == 'public') {
                                                ?>  
                                        <br><br>
                                                <table id="" class="table table-striped table-bordered " style="width: 100%" >
                                                    <thead>
                                                        <tr>
                                                            <th>Intiule</th>                                                                
                                                            <th>Etat</th>                                         
                                                            <th>date de connaissance marche</th>
                                                            <th>date de prescription</th>
                                                            <th>date de depot de depot de dossier</th>
                                                            <th>date de reponse</th>

                                                        </tr>
                                                    <tbody>
                                                        <?php
                                                        foreach ($markets as $market) {
                                                            ?> 
                                                            <tr>
                                                                <td>
                                                                    <?= HTML::Encode($market['intitule']); ?> 
                                                                </td>
                                                                <td>
                                                                    <?= HTML::Encode($market['etat']); ?>
                                                                </td>
                                                                <td>
                                                                    <?= HTML::Encode($market['date_connaiss']); ?>
                                                                </td>
                                                                <td>
                                                                    <?= HTML::Encode($market['date_prescript']); ?>
                                                                </td>
                                                                <td>
                                                                    <?= HTML::Encode($market['date_depot_dossier']); ?>
                                                                </td>
                                                                <td>
                                                                    <?= HTML::Encode($market['date_reponse']); ?>
                                                                </td>

                                                            </tr>
                                                        <?php }
                                                        ?> 
                                                    </tbody>
                                                </table>
                                                <?php
                                            }
                                        } else {
                                            ?>

                                            <div align="center">
                                                <br><br>
                                                <div class="label label-info"  style="font-size: 100%">AUCUN MARCHE A AFFICHER.</div>
                                            </div>
                                            <?php
                                        }
                                        ?>


                                    </div>
                                    <?php
                                }
                                    ?>

                                </div>

                                <div class="tab-pane active" id="infos">
                                    <div class="x_content">
                                        <br><br>
                                        <?=
                                        DetailView::widget([
                                            'model' => $model,
                                            'attributes' => [
                                                'denomination',
                                                'raison_sociale',
                                                'type',
                                                'localisation',
                                                'email',
                                                'telephone',
                                                'boite_postale',
                                                'adresse_web',
                                                'personne_source',
                                                'telephone_source',
                                            ],
                                        ]);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="margin-left: 69%">
                            <h2> <?= Html::a('<i class="glyphicon glyphicon-menu-left"></i><i class="glyphicon glyphicon-menu-left"></i>Retour à la Page precedente', ['customer/view-customers'], ['class' => 'profile-link']) ?> </h2>
                        </div> 
                    </div>
                </div>
            </div>
        </div>

        <?php $this->registerCssFile('css/libs/jquery-ui.css') ?>
        <?php $this->registerCssFile('css/libs/dataTables.jqueryui.min.css') ?>
        <?php $this->registerCssFile('css/CustomerMarketAppointmentPurch.css') ?>

        <?php $this->registerJsFile('js/libs/jquery.dataTables.min.js') ?>
        <?php $this->registerJsFile('js/libs/dataTables.keyTable.min.js') ?>
        <?php $this->registerJsFile('js/libs/dataTables.jqueryui.min.js') ?>

<script>


    $(document).ready(function () {

        $('table').DataTable({
            responsive: true,
            keys: true
        });
    });

</script>
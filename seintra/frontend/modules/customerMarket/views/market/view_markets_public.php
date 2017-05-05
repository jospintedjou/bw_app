<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use common\models\Client;
use kartik\date\DatePicker;
use kartik\widgets\Select2;

$this->title = 'Marchés Publics';
?>
<?php include 'form_to_add_markets.php'; ?>
<?php include 'Market_Flash_messages.php'; ?>

<!-- page content -->
<div class="right_col" role="main">                  
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Nos Marchés Publics</h3>
            </div>      
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">
                            <button role="menuitem" tabindex="-1" class="btn btn-primary " data-toggle="modal" data-target="#formDivPublic">
                                &nbsp; Créer un Marché Public 
                            </button>  
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <?php
                    ?>

                    <div class="tab-content clearfix">

                        <div class="tab-pane active" id="marchepublic">
                            <div class="x_content">
                                <?php if ($publicmarkets != null) { ?> 
                                    <table id="" class="table table-striped table-bordered" style="width: 100%" >
                                        <thead>
                                            <tr>
                                                <th class="search">Intitulé Marchés Publics</th>                                                                
                                                <th class="search">Clients</th>                                         
                                                <th class="search">Etat</th>
                                                <th>Edit<br><br><br></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($publicmarkets as $public_market) {
                                                ?>   
                                                <tr>
                                                    <?php $id_public_market = "public" . $public_market['id_marche']; ?>
                                                    <?php $data_target_view_public = "#" . $id_public_market; ?>
                                                    <?php $id_public = $public_market['id_marche']; ?>
                                                    <?php $data_target_edit_public = "#" . $id_public; ?>
                                                    <td>
                                                        <a><?= $public_market['intitule']; ?> </a>                           
                                                    </td>

                                                    <td>
                                                        <?= $public_market->findnamepubliccustomer($public_market['id_client']); ?> 
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($public_market['etat'] == 'en_attente') {
                                                            echo 'en attente';
                                                        } else
                                                            echo $public_market['etat'];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a  class="btn btn-primary btn-xs" data-toggle="modal" data-target="<?= $data_target_view_public ?>">
                                                            <i class="glyphicon glyphicon-eye-open"></i> View </a>

                                                        <div class="modal fade miguel" id="<?= $id_public_market ?>" tabindex="-1" role="dialog"
                                                             aria-labelledby="myModalLabel" aria-hidden="true" >
                                                            <div class="modal-dialog">
                                                                <div class="modal-content" style="width: 120%">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                            &times;
                                                                        </button>
                                                                        <h4 class="modal-title" id="myModalLabel" align=" center">
                                                                            Marché Public
                                                                        </h4>
                                                                    </div>                                                                   
                                                                    <div class="modal-body">


                                                                        <div class='row' style="margin-left:2px;margin-right:2px;color: #0d3349">
                                                                            <div>
                                                                                <div class="row ">
                                                                                    <div class="col-lg-4 view_marche_even "><br> intitulé marché:<br> </div> 
                                                                                    <div class="col-lg-8 view_marche_even"><br><strong><?= $public_market['intitule']; ?></strong><br></div>
                                                                                </div>
                                                                                <div class="row" style="border: ">
                                                                                    <div class="col-lg-4 view_marche_odd "><br>Nom du client:<br></div> 
                                                                                    <div class="col-lg-8 view_marche_odd"><br><strong><?= $public_market->findnamepubliccustomer($public_market['id_client']); ?></strong><br></div>
                                                                                </div>
                                                                                <div class="row " >
                                                                                    <div class="col-lg-4 view_marche_even"><br>date de connaissance marché:<br></div>
                                                                                    <div class="col-lg-8 view_marche_even">
                                                                                        <br><strong> 
                                                                                            <?php if (( $public_market['date_connaiss']) != null) { ?>
                                                                                                <?= $public_market['date_connaiss']; ?>
                                                                                            <?php } else { ?>

                                                                                            <?php }
                                                                                            ?> 
                                                                                        </strong><br>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row" >
                                                                                    <div class="col-lg-4 view_marche_odd"><br>délai de prescription:<br></div>
                                                                                    <div class="col-lg-8 view_marche_odd">
                                                                                        <br><strong>
                                                                                            <?php if (($public_market['date_prescript']) != null) { ?>
                                                                                                <?= $public_market['date_prescript']; ?>
                                                                                            <?php } else { ?>

                                                                                            <?php }
                                                                                            ?>   
                                                                                        </strong><br>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-4 view_marche_even"><br>date d'introduction du dossier:<br></div>
                                                                                    <div class="col-lg-8 view_marche_even">
                                                                                        <br><strong>

                                                                                            <?php if (( $public_market['date_depot_dossier']) != null) { ?>
                                                                                                <?= $public_market['date_depot_dossier']; ?>
                                                                                            <?php } else { ?>

                                                                                            <?php }
                                                                                            ?>     
                                                                                        </strong><br>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row" >
                                                                                    <div class="col-lg-4 view_marche_odd"><br>date réponse client:<br></div>
                                                                                    <div class="col-lg-8 view_marche_odd">
                                                                                        <br><strong>
                                                                                            <?php if (($public_market['date_reponse']) != null) { ?>
                                                                                                <?= $public_market['date_reponse']; ?>
                                                                                            <?php } else { ?>

                                                                                            <?php }
                                                                                            ?>
                                                                                        </strong><br>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-4 view_marche_even"><br>Etat marché:<br></div>
                                                                                    <div class="col-lg-8 view_marche_even">
                                                                                        <br><strong>
                                                                                            <?php
                                                                                            if ($public_market['etat'] == 'en_attente') {
                                                                                                echo 'en attente';
                                                                                            } else
                                                                                                echo $public_market['etat'];
                                                                                            ?>                                                  
                                                                                        </strong><br>
                                                                                    </div>   
                                                                                </div>
                                                                            </div> 
                                                                        </div>
                                                                    </div> 
                                                                    <!-- /.modal-body  view-->

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                                                            Close
                                                                        </button>

                                                                    </div>

                                                                </div> <!-- /.modal content view -->
                                                            </div> <!-- /.modal dialog view-->
                                                        </div>
                                                        <?php if (Yii::$app->user->identity->role != 'DEV') { ?>
                                                            <a class="btn btn-info btn-xs " data-toggle="modal" data-target= <?= $data_target_edit_public . 'public' ?>> 
                                                                <i class="fa fa-pencil">Edit </i>
                                                            </a >
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a class="btn btn-info btn-xs " disabled> 
                                                                <i class="fa fa-pencil">Edit </i>
                                                            </a >
                                                            <?php
                                                        }
                                                        ?>
                                                        <div class="modal fade miguel" id="<?= $id_public . 'public' ?>"tabindex="-1" role="dialog"
                                                             aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close closemodal" data-dismiss="modal" aria-hidden="true">
                                                                            &times;
                                                                        </button>
                                                                        <h4 class="modal-title" id="myModalLabel" style="text-align: center">
                                                                            Marché Public
                                                                        </h4>
                                                                    </div>

                                                                    <?php
                                                                    $publicmarket->intitule = $public_market['intitule'];
                                                                    $publicmarket->etat = $public_market['etat'];


                                                                    $publicmarket->date_depot_dossier = $public_market['date_depot_dossier'];



                                                                    $publicmarket->delai_prescript = $public_market['date_prescript'];



                                                                    $publicmarket->date_connaiss = $public_market['date_connaiss'];


                                                                    $publicmarket->date_reponse = $public_market['date_reponse'];


                                                                    $publicmarket->date_reponse = $public_market['date_reponse'];


                                                                    $publicmarket->client = $public_market['id_client'];

                                                                    $publicmarket->id_marche = $public_market['id_marche'];
                                                                    ?>

                                                                    <?php
                                                                    $form = ActiveForm::begin(['action' => Url::toRoute(['market/update-public-market']), 'method' => 'post'])
                                                                    ?> 

                                                                    <div class="modal-body">			  
                                                                        <?= $form->field($publicmarket, 'intitule')->textInput() ?>                  
                                                                        <?=
                                                                        $form->field($publicmarket, 'client')->widget(Select2::className(), [
                                                                            'hideSearch' => true,
																			'data' => $clientsPublic,
                                                                            'theme' => Select2::THEME_BOOTSTRAP,
                                                                            'options' => ['placeholder' => 'Select client ...', 'id' => $id_public . 'edit_client'],
                                                                            'pluginOptions' => [
                                                                                'allowClear' => true
                                                                            ],
                                                                        ]);
                                                                        ?>
                                                                        <?=
                                                                        $form->field($publicmarket, 'date_connaiss')->widget(DatePicker::classname(), [
                                                                            'options' => ['placeholder' => 'veuillez entrer la date de connaissance du marche', 'id' => $id_public . 'date_connaiss'],
                                                                            'pluginOptions' => [
                                                                                'format' => 'yyyy-mm-dd',
                                                                                'endDate' => '0d',
                                                                                'autoclose' => true
                                                                            ]
                                                                        ]);
                                                                        ?>                                                 
                                                                        <?=
                                                                        $form->field($publicmarket, 'date_depot_dossier')->widget(DatePicker::classname(), [
                                                                            'options' => ['placeholder' => 'veuillez entrer la date de depot du dossier', 'id' => $id_public . 'date_depot_dossier'],
                                                                            'pluginOptions' => [
                                                                                'format' => 'yyyy-mm-dd',
                                                                                'autoclose' => true
                                                                            ]
                                                                        ]);
                                                                        ?> 
                                                                        <?=
                                                                        $form->field($publicmarket, 'delai_prescript')->widget(DatePicker::classname(), [
                                                                            'options' => ['placeholder' => 'veuillez entrer la date de delai de prescription', 'id' => $id_public . 'delai_prescript'],
                                                                            'pluginOptions' => [
                                                                                'format' => 'yyyy-mm-dd',
                                                                                'endDate' => '0d',
                                                                                'autoclose' => true
                                                                            ]
                                                                        ]);
                                                                        ?> 
                                                                        <?= $form->field($publicmarket, 'etat')->dropDownList(['en_attente' => 'en attente', 'gagne' => 'gagne', 'perdu' => 'perdu']) ?>
                                                                        <?=
                                                                        $form->field($publicmarket, 'date_reponse')->widget(DatePicker::classname(), [
                                                                            'options' => ['placeholder' => 'veuillez entrer la date de reponse', 'id' => $id_public . 'date_reponse0'],
                                                                            'pluginOptions' => [
                                                                                'format' => 'yyyy-mm-dd',
                                                                                'startDate' => '0d',
                                                                                'autoclose' => true
                                                                            ]
                                                                        ]);
                                                                        ?>    

                                                                        <div style="display:none">
                                                                            <?= $form->field($publicmarket, 'id_marche') ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <?=
                                                                        Html::submitButton('Mettre à jour', ['class' => 'btn btn-primary',
                                                                        ])
                                                                        ?>  
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal" id="close">
                                                                            Close
                                                                        </button> 
                                                                        <div style="display: none">
                                                                            <?= Html::resetButton('Reset', ['class' => 'resetForm', 'id' => 'resetForm']) ?> 
                                                                        </div>
                                                                        <?php ActiveForm::end(); ?>
                                                                    </div><!-- /.modal content -->
                                                                </div><!-- /.modal dialog-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                            <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php } else {
                                    ?>
                                    <div align="center">
                                        <div class="label label-info"  style="font-size: 100%">AUCUN MARCHE PUBLIC A AFFICHER</div>
                                    </div>
                                    <?php
                                }
                                ?>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /page content -->
<div class="modal fade miguel" id="formDivPublic" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close closemodal" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel" align=" center">
                    Nouveau Marché Public
                </h4>
            </div>

            <div class="modal-body">			  
                <?php
                $publicmarket = new frontend\modules\customerMarket\models\PublicMarketForm();
                $public_form = ActiveForm::begin(['action' => Url::toRoute(['market/create-public-market']), 'method' => 'post'])
                ?> 

                <div class="modal-body">			  

                    <?= $public_form->field($publicmarket, 'intitule')->textInput() ?>                  
                    <?=
                    $public_form->field($publicmarket, 'client')->widget(Select2::className(), [

                        'hideSearch' => true,
                        'data' => $clientsPublic,
                        'theme' => Select2::THEME_BOOTSTRAP,
                        'options' => ['placeholder' => 'Select client ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                    <?=
                    $public_form->field($publicmarket, 'date_connaiss')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'veuillez entrer la date de connaissance du marche'],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'endDate' => '0d',
                            'todayHighlight' => true,
                            'todayBtn' => true,
                            'autoclose' => true
                        ]
                    ]);
                    ?>                                                 
                    <?=
                    $public_form->field($publicmarket, 'date_depot_dossier')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'veuillez entrer la date de depot du dossier'],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight' => true,
                            'todayBtn' => true,
                            'autoclose' => true
                        ]
                    ]);
                    ?> 
                    <?=
                    $public_form->field($publicmarket, 'delai_prescript')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'veuillez entrer la date de delai de prescription'],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,
                            'todayHighlight' => true,
                        ]
                    ]);
                    ?> 
                    <?= $public_form->field($publicmarket, 'etat', ['inputOptions' => ['id' => 'etat_public']])->dropDownList(['en_attente' => 'en attente', 'gagne' => 'gagne', 'perdu' => 'perdu']) ?>
                    <?=
                    $public_form->field($publicmarket, 'date_reponse')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'veuillez entrer la date de reponse'],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'startDate' => '0d',
                            'todayHighlight' => true,
                            'todayBtn' => true,
                            'autoclose' => true
                        ]
                    ]);
                    ?>                    
                </div>

                <div class="modal-footer">
                    <?= Html::submitButton('Ajouter', ['class' => 'btn btn-primary']) ?>  
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button> 
                    <div style="display: none">
                        <?= Html::resetButton('Reset', ['class' => 'resetForm', 'id' => 'resetForm']) ?> 
                    </div>
                </div>
                <?php ActiveForm::end(); ?>


            </div><!-- /.modal-body -->
        </div><!-- /.modal content -->
    </div><!-- /.modal dialog-->
</div>

<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use common\models\Client;
use kartik\date\DatePicker;
use kartik\widgets\Select2;

$this->title = 'Marchés Privés';
?>
<?php include 'form_to_add_markets.php'; ?>
<?php include 'Market_Flash_messages.php'; ?>

<!-- page content -->
<div class="right_col" role="main">                  
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Nos Marchés Privés</h3>
            </div>      
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">                           
                            <button role="menuitem" tabindex="-1" class="btn btn-primary " data-toggle="modal" data-target="#privatemarket">
                                &nbsp; Créer un Marché Privé 
                            </button>
                        </ul>

                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <?php
                    ?>
                    <div class="tab-content clearfix">
                        <div class="tab-pane active" id="marcheprive">
                            <div class="x_content">
                                <!-- start Markets  list -->

                                <?php if ($privatemarkets != null) { ?> 
                                    <table id="" class="table table-striped table-bordered " >
                                        <thead>
                                            <tr>
                                                <th class="search">Intitulé Marchés Privés</th>                                                                
                                                <th class="search">Clients</th>                                         
                                                <th class="search">Etat</th>                    
                                                <th>Edit<br><br><br></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($privatemarkets as $privatmarket) {
                                                ?>   
                                                <tr>
                                                    <?php $id_private_market = "private" . $privatmarket['id_marche']; ?>
                                                    <?php $target_id_private_market = "#" . $id_private_market; ?>
                                                    <?php $id = $privatmarket['id_marche']; ?>
                                                    <?php $data_target = "#" . $id; ?>
                                                    <td>
                                                        <a><?= $privatmarket['intitule']; ?> </a>

                                                    </td>
                                                    <td>
                                                        <?= $privatmarket->findnameprivatecustomer($privatmarket['id_client']); ?> 
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($privatmarket['etat'] == 'en_attente') {
                                                            echo 'en attente';
                                                        } else
                                                            echo $privatmarket['etat'];
                                                        ?>
                                                    </td>

                                                    <td>
                                                        <a  class="btn btn-primary btn-xs" data-toggle="modal" data-target="<?= $target_id_private_market ?>">
                                                            <i class="glyphicon glyphicon-eye-open"></i>View</a>

                                                        <div class="modal fade" id="<?= $id_private_market ?>" tabindex="-1" role="dialog"
                                                             aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content" style="width:120%">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close " data-dismiss="modal" aria-hidden="true">
                                                                            &times;
                                                                        </button>
                                                                        <h4 class="modal-title" id="myModalLabel" align="center">
                                                                            Marché Privé 
                                                                        </h4>
                                                                    </div>                                                                                                                                      
                                                                    <div class="modal-body">
                                                                        <div class='row' style="margin-left:2px;margin-right:2px;color: #0d3349 ">
                                                                            <div>
                                                                                <div class="row " style="">
                                                                                    <div class="col-lg-4 view_marche_even "><br>intitulé marché:<br> </div> 
                                                                                    <div class="col-lg-8 view_marche_even"><br><strong> <?= $privatmarket['intitule']; ?></strong><br></div>
                                                                                </div>
                                                                                <div class="row" style="border: ">
                                                                                    <div class="col-lg-4 view_marche_odd "><br>Nom du client:<br></div> 
                                                                                    <div class="col-lg-8 view_marche_odd"><br><strong> <?= $privatmarket->findnameprivatecustomer($privatmarket['id_client']); ?></strong><br></div>
                                                                                </div>
                                                                                <div class="row " style="">
                                                                                    <div class="col-lg-4 view_marche_even"><br>date de demande de cotation:<br></div>
                                                                                    <div class="col-lg-8 view_marche_even">
                                                                                        <br> <strong> 
                                                                                            <?php if (($privatmarket['date_dmd_cotation']) != null) { ?>
                                                                                                <?= $privatmarket['date_dmd_cotation']; ?>
                                                                                            <?php } else { ?>

                                                                                            <?php }
                                                                                            ?>  
                                                                                        </strong><br>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-4 view_marche_odd"><br>date de dépot de cotation:<br></div>
                                                                                    <div class="col-lg-8 view_marche_odd">
                                                                                        <br><strong>
                                                                                            <?php if (($privatmarket['date_depot_cotation']) != null) { ?>
                                                                                                <?= $privatmarket['date_depot_cotation']; ?>
                                                                                            <?php } else { ?>

                                                                                            <?php }
                                                                                            ?>
                                                                                        </strong><br>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row" >
                                                                                    <div class="col-lg-4 view_marche_even"><br>date réponse client:<br></div>
                                                                                    <div class="col-lg-8 view_marche_even">
                                                                                        <br><strong>
                                                                                            <?php if (($privatmarket['date_reponse']) != null) { ?>
                                                                                                <?= $privatmarket['date_reponse']; ?>
                                                                                            <?php } else { ?>
                                                                                            <?php }
                                                                                            ?>  
                                                                                        </strong><br>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row" style="">
                                                                                    <div class="col-lg-4 view_marche_odd"><br>Etat marché:<br></div>
                                                                                    <div class="col-lg-8 view_marche_odd">
                                                                                        <br><strong>
                                                                                            <?php
                                                                                            if ($privatmarket['etat'] == 'en_attente') {
                                                                                                echo 'en attente';
                                                                                            } else
                                                                                                echo $privatmarket['etat'];
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
                                                            <a class="btn btn-info btn-xs " data-toggle="modal" data-target= <?= $data_target ?>> 
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
                                                        <div class="modal fade miguel" id="<?= $id ?>"tabindex="-1" role="dialog"
                                                             aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close closemodal" data-dismiss="modal" aria-hidden="true">
                                                                            &times;
                                                                        </button>
                                                                        <h4 class="modal-title" id="myModalLabel" style="text-align: center">
                                                                            Marché Privé
                                                                        </h4>
                                                                    </div>
                                                                    <?php
                                                                    $privatemarket->intitule = $privatmarket['intitule'];
                                                                    $privatemarket->etat = $privatmarket['etat'];
                                                                    $privatemarket->date_dmd_cotation = $privatmarket['date_dmd_cotation'];
                                                                    $privatemarket->date_depot_cotation = $privatmarket['date_depot_cotation'];
                                                                    $privatemarket->date_reponse = $privatmarket['date_reponse'];
                                                                    $privatemarket->client = $privatmarket['id_client'];
                                                                    $privatemarket->id_marche = $privatmarket['id_marche'];
                                                                    ?>
                                                                    <?php $form = ActiveForm::begin(['action' => Url::toRoute(['market/update-private-market']), 'method' => 'post']) ?> 

                                                                    <div class="modal-body">			  

                                                                        <?= $form->field($privatemarket, 'intitule')->textInput() ?>                  
                                                                        <?=
                                                                        $form->field($privatemarket, 'client')->widget(Select2::className(), [

                                                                            'hideSearch' => true,
                                                                            'data' => $clientsPrive,
                                                                            'theme' => Select2::THEME_BOOTSTRAP,
                                                                            'options' => ['placeholder' => 'Select client ...', 'id' => $id . 'client'],
                                                                            'pluginOptions' => [
                                                                                'allowClear' => true
                                                                            ],
                                                                        ]);
                                                                        ?>


                                                                        <?=
                                                                        $form->field($privatemarket, 'date_dmd_cotation')->widget(DatePicker::classname(), [
                                                                            'options' => ['placeholder' => 'veuillez entrer la date de demande de cotation', 'id' => $id . 'date_dmd_cotation'],
                                                                            'pluginOptions' => [
                                                                                'format' => 'yyyy-mm-dd',
                                                                                'endDate' => '0d',
                                                                                'autoclose' => true
                                                                            ]
                                                                        ]);
                                                                        ?>                                                 
                                                                        <?=
                                                                        $form->field($privatemarket, 'date_depot_cotation')->widget(DatePicker::classname(), [
                                                                            'options' => ['placeholder' => 'veuillez entrer la date de depot de cotation', 'id' => $id . 'date_depot_cotation'],
                                                                            'pluginOptions' => [
                                                                                'format' => 'yyyy-mm-dd',
                                                                                'autoclose' => true
                                                                            ]
                                                                        ]);
                                                                        ?> 
                                                                        <?= $form->field($privatemarket, 'etat')->dropDownList(['en_attente' => 'en attente', 'gagne' => 'gagne', 'perdu' => 'perdu']) ?>
                                                                        <?=
                                                                        $form->field($privatemarket, 'date_reponse')->widget(DatePicker::classname(), [
                                                                            'options' => ['placeholder' => 'veuillez entrer la date de reponse', 'id' => $id . 'date_reponse'],
                                                                            'pluginOptions' => [
                                                                                'format' => 'yyyy-mm-dd',
                                                                                'startDate' => '0d',
                                                                                'autoclose' => true
                                                                            ]
                                                                        ]);
                                                                        ?>           
                                                                        <div style="display:none"> 
                                                                            <?= $form->field($privatemarket, 'id_marche') ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <?= Html::submitButton('Mettre à jour', ['class' => 'btn btn-primary']) ?>  
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                                                            Close
                                                                        </button> 
                                                                        <div style="display: none">
                                                                            <?= Html::resetButton('Reset', ['class' => 'resetForm', 'id' => 'resetForm']) ?> 
                                                                        </div>
                                                                    </div>
                                                                    <?php ActiveForm::end(); ?>
                                                                </div><!-- /.modal content -->
                                                            </div><!-- /.modal dialog-->
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
                                        <div class="label label-info"  style="font-size: 100%">AUCUN MARCHE PRIVE A AFFICHER</div>
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
<!-- /page content -->

<div class="modal fade miguel" id="privatemarket" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close closemodal" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel" style="text-align: center">
                    Nouveau Marché Privé
                </h4>
            </div>
            <?php
            $priv_market = new frontend\modules\customerMarket\models\PrivateMarketForm();
            $prives = $clientsPrive;
            $private_form = ActiveForm::begin(['action' => Url::toRoute(['market/create-private-market']), 'method' => 'post'])
            ?> 

            <div class="modal-body">			  

                <?= $private_form->field($priv_market, 'intitule')->textInput() ?>  

                <?=
                $private_form->field($priv_market, 'client')->widget(Select2::className(), [

                    'hideSearch' => true,
                    'data' => $prives,
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'options' => ['placeholder' => 'Select client ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>

                <?=
                $private_form->field($priv_market, 'date_dmd_cotation')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'veuillez entrer la date de demande de cotation'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                        'todayBtn' => true,
                        'endDate' => '0d',
                        'autoclose' => true
                    ]
                ]);
                ?>                                                 
                <?=
                $private_form->field($priv_market, 'date_depot_cotation')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'veuillez entrer la date de depot de cotation'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                        'todayBtn' => true,
                        'autoclose' => true
                    ]
                ]);
                ?> 
                <?= $private_form->field($priv_market, 'etat', ['inputOptions' => ['id' => 'etat_private']])->dropDownList(['en_attente' => 'en attente', 'gagne' => 'gagne', 'perdu' => 'perdu']) ?>

                <?=
                $private_form->field($priv_market, 'date_reponse')->widget(DatePicker::classname(), [
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
                <button type="button" class="btn btn-default" data-dismiss="modal" id="close">
                    Close
                </button> 
                <div style="display: none">
                    <?= Html::resetButton('Reset', ['class' => 'resetForm', 'id' => 'resetForm']) ?> 
                </div>

            </div>
            <?php ActiveForm::end(); ?>


        </div><!-- /.modal content -->
    </div><!-- /.modal dialog-->

</div>
